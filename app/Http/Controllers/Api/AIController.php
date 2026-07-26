<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;

use Illuminate\Http\Client\PendingRequest;


class AIController extends Controller

{

    /** Koliko poruka iz istorije šaljemo max */

    private const HISTORY_LIMIT = 6;


    /** Default OpenAI model (može iz .env) */

    private function model(): string

    {

        return (string) config('services.openai.model', 'gpt-4o-mini');

    }


    /** Plan korisnika (za kasnije ograničenja/feature gating) */

    protected function getUserPlan(Request $request): string

    {

        return $request->user()?->plan ?? 'starter';

    }


    /** Dnevni limiti po planu (trenutno neaktivno – vidi ispod) */

    protected function getDailyLimit(string $plan, string $type): int

    {

        $limits = [

            'suggest' => ['starter'=>2,'basic'=>3,'pro'=>5,'premium'=>7,'business'=>10],

            'chat'    => ['starter'=>5,'basic'=>10,'pro'=>20,'premium'=>40,'business'=>100],

        ];

        return $limits[$type][$plan] ?? 2;

    }


    /** Jednostavan limiter po userId/IP (trenutno isključen) */

    protected function checkAndTrackLimit(Request $request, string $type): bool|string

    {

        $plan    = $this->getUserPlan($request);

        $limit   = $this->getDailyLimit($plan, $type);

        $keyBase = $request->user()?->id ? ('u:'.$request->user()->id) : ('ip:'.$request->ip());

        $cacheKey= "ai_{$type}_limit_{$keyBase}";

        $used    = Cache::get($cacheKey, 0);


        if ($used >= $limit) {

            return "Dostigli ste dnevni limit za AI ({$type}) zahteve za paket: {$limit}.";

        }


        Cache::put($cacheKey, $used + 1, now()->endOfDay());

        Log::info("������ AI ($type) usage", ['key'=>$keyBase,'plan'=>$plan,'used'=>$used+1,'limit'=>$limit]);

        return true;

    }


    /** Prekonfigurisani HTTP klijent ka OpenAI */

    protected function openai(): PendingRequest

    {

        $key     = config('services.openai.key');

        $timeout = (int) config('services.openai.timeout', 20);


        if (!$key) {

            abort(500, 'OpenAI API ključ nije podešen.');

        }


        $client = Http::withToken($key)

            ->timeout($timeout)

            ->connectTimeout(5)

            ->acceptJson();


        // (opciono) organizacija/projekat — ako koristiš project-scoped ključeve

        if ($org = config('services.openai.org')) {

            $client = $client->withHeaders(['OpenAI-Organization' => $org]);

        }

        if ($proj = config('services.openai.project')) {

            $client = $client->withHeaders(['OpenAI-Project' => $proj]);

        }


        return $client;

    }


    /** Mapiranje OpenAI grešaka u čitljive i bezbedne poruke za klijenta */

    protected function mapOpenAiError(array $body = null, int $status = 500): string

    {

        if ($status === 401) {

            return 'AI servis nije pravilno konfigurisan. Obratite se podršci.';

        }

        if ($status === 429) {

            return 'AI servis je trenutno zauzet. Pokušajte ponovo za nekoliko trenutaka.';

        }

        if ($status >= 500) {

            return 'AI servis trenutno nije dostupan.';

        }

        return $body['error']['message'] ?? 'Greška u komunikaciji sa AI.';

    }


    /** Lagan “one-shot” predlog */

    public function suggest(Request $request)

    {

        $request->validate(['prompt' => 'required|string|max:1000']);

        $prompt = trim($request->input('prompt', ''));


        // Keš 12h (podesivo preko .env: AI_SUGGEST_CACHE_HOURS)

        $ttlHours = (int) env('AI_SUGGEST_CACHE_HOURS', 12);

        $cacheKey = 'ai:suggest:'.sha1(mb_strtolower($prompt));


        if ($cached = Cache::get($cacheKey)) {

            return response()->json(['suggestion' => $cached, 'cached' => true]);

        }


        // (po potrebi) uključi limit:

        // $check = $this->checkAndTrackLimit($request, 'suggest');

        // if ($check !== true) return response()->json(['error'=>$check], 429);


        $model = $this->model();


        try {

            $res = $this->openai()->post('https://api.openai.com/v1/chat/completions', [

                'model'       => $model,

                'messages'    => [

                    ['role' => 'system', 'content' => 'Odgovaraj kratko, jasno i korisno.'],

                    ['role' => 'user',   'content' => $prompt],

                ],

                'temperature' => 0.7,

                'max_tokens'  => 250,

            ]);

        } catch (\Throwable $e) {

            Log::error('OpenAI suggest transport error', ['ex'=>Str::limit($e->getMessage(), 300)]);

            return response()->json(['error' => 'AI servis trenutno nije dostupan.'], 502);

        }


        if ($res->failed()) {

            $status = $res->status();

            $body   = $res->json();

            Log::error('OpenAI suggest error', [

                'status'=>$status,

                'body'=>Str::limit(json_encode($body, JSON_UNESCAPED_UNICODE), 1000),

                'openai_request_id'=>$res->header('x-request-id'),

            ]);

            $msg = $this->mapOpenAiError($body ?? [], $status);

            return response()->json(['error' => $msg], $status ?: 502);

        }


        $content = trim($res->json('choices.0.message.content') ?? 'Nema odgovora.');

        Cache::put($cacheKey, $content, now()->addHours($ttlHours));


        return response()->json(['suggestion' => $content, 'cached' => false]);

    }


    /** Chat sa kratkom istorijom */

    public function chat(Request $request)

    {

        $request->validate([

            'message' => 'required|string|max:1000',

            'history' => 'array',

        ]);


        // (po potrebi) uključi limit:

        // $check = $this->checkAndTrackLimit($request, 'chat');

        // if ($check !== true) return response()->json(['error'=>$check], 429);


        $model = $this->model();


        // do 6 poslednjih poruka

        $history = collect((array) $request->input('history', []))

            ->slice(-self::HISTORY_LIMIT)

            ->map(function ($m) {

                $role = ($m['role'] ?? '') === 'user' ? 'user' : 'assistant';

                $content = trim((string) ($m['content'] ?? ''));

                return ['role' => $role, 'content' => mb_substr($content, 0, 1000)];

            })

            ->values()

            ->all();


        $messages = array_merge(

            [['role' => 'system', 'content' => 'Ti si ljubazan virtuelni asistent firme Express Web. Odgovaraj kratko, jasno i korisno.']],

            $history,

            [['role' => 'user', 'content' => trim($request->message)]],

        );


        try {

            $res = $this->openai()->post('https://api.openai.com/v1/chat/completions', [

                'model'       => $model,

                'messages'    => $messages,

                'temperature' => 0.7,

                'max_tokens'  => 300,

            ]);

        } catch (\Throwable $e) {

            Log::error('OpenAI chat transport error', ['ex'=>Str::limit($e->getMessage(), 300)]);

            return response()->json(['error' => 'AI servis trenutno nije dostupan.'], 502);

        }


        if ($res->failed()) {

            $status = $res->status();

            $body   = $res->json();

            Log::error('OpenAI chat error', [

                'status'=>$status,

                'body'=>Str::limit(json_encode($body, JSON_UNESCAPED_UNICODE), 1000),

                'openai_request_id'=>$res->header('x-request-id'),

            ]);

            $msg = $this->mapOpenAiError($body ?? [], $status);

            return response()->json(['error' => $msg], $status ?: 502);

        }


        $content = trim($res->json('choices.0.message.content') ?? 'Nema odgovora.');

        return response()->json(['reply' => $content]);

    }

}
