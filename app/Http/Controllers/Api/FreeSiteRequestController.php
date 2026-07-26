<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use App\Models\FreeSiteRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;


class FreeSiteRequestController extends Controller

{

    /* =========================

       STORE (public)

       ========================= */

    public function store(Request $request)

    {

        // 1) Normalizuj camelCase -> snake_case (i fajlove)

        $this->normalize($request);


        // 2) Validacija — usklađena sa frontom (snake_case)

        $validated = $request->validate($this->rules('store'));


        // 3) Sastavi podatke i snimi

        $data = $this->buildData($request, $validated);

        $data['slug']    = Str::slug($validated['name']).'-'.uniqid();

        $data['user_id'] = optional($request->user())->id;         // može biti null za guest

        $data['status']  = 'pending';

        $data['plan']    = $request->input('plan', 'starter');


        $record = FreeSiteRequest::create($data);


        return response()->json([

            'message' => '✅ Prezentacija sačuvana!',

            'slug'    => $record->slug,

        ], 201);

    }


    /* =========================

       SHOW (public + zaštita za neaktivne)

       ========================= */

    public function show($slug)

    {

        $site = FreeSiteRequest::where('slug', $slug)->first();

        if (!$site) {

            return response()->json(['error' => 'Prezentacija nije pronađena.'], 404);

        }


        if ($site->status !== 'active') {

            $user    = auth('sanctum')->user();

            $isOwner = $user && $user->id === $site->user_id;

            $isAdmin = $user && in_array($user->role, ['admin','superadmin']);

            if (!$isOwner && !$isAdmin) {

                return response()->json(['error' => 'Nemate pristup ovoj prezentaciji.'], 401);

            }

        }


        return response()->json($site);

    }


    /* =========================

       UPDATE (zaštićeno)

       ========================= */

    public function update(Request $request, $slug)

    {

        $site = FreeSiteRequest::where('slug', $slug)->firstOrFail();


        $user    = auth()->user();

        $isOwner = $user && $user->id === $site->user_id;

        $isAdmin = $user && in_array($user->role, ['admin','superadmin']);

        if (!$isOwner && !$isAdmin) {

            return response()->json(['message' => '⛔ Nemaš dozvolu.'], 403);

        }


        // 1) Normalizuj payload (prihvati i camelCase ključeve iz starog fronta)

        $this->normalize($request);


        // 2) Validacija — na update su slike opcione

        $validated = $request->validate($this->rules('update'));


        // 3) Sastavi podatke + fallback na postojeće fajlove i ponudu

        $data = $this->buildData($request, $validated, $site);


        $site->fill($data)->save();


        return response()->json([

            'message' => '✅ Prezentacija ažurirana.',

            'slug'    => $site->slug,

        ]);

    }


    /* =========================

       DESTROY (zaštićeno)

       ========================= */

    public function destroy($slug)

    {

        $site = FreeSiteRequest::where('slug', $slug)->firstOrFail();


        $user    = auth()->user();

        $isOwner = $user && $user->id === $site->user_id;

        $isAdmin = $user && in_array($user->role, ['admin','superadmin']);

        if (!$isOwner && !$isAdmin) {

            return response()->json(['message' => '⛔ Nemaš dozvolu.'], 403);

        }


        $site->delete();

        return response()->json(['message' => '������ Prezentacija obrisana.']);

    }


    /* =========================

       INDEX (za admin panele itd.)

       ========================= */

    public function index()

    {

        return FreeSiteRequest::latest()->get();

    }


    /* =========================

       CHANGE STATUS (zaštićeno)

       ========================= */

    public function changeStatus(Request $request, $slug)

    {

        $site = FreeSiteRequest::where('slug', $slug)->firstOrFail();

        $user = auth()->user();

        if (!$user || !in_array($user->role, ['admin','superadmin'])) {

            return response()->json(['message' => 'Nemaš dozvolu.'], 403);

        }


        $validated = $request->validate([

            'status' => 'required|in:pending,active,rejected'

        ]);


        $site->status = $validated['status'];

        $site->save();


        return response()->json(['message' => 'Status ažuriran.']);

    }


    /* =========================

       DEMO SITES (public)

       ========================= */

    public function demoSites()

    {

        return FreeSiteRequest::where('is_demo', true)

            ->where('status', 'active')

            ->orderBy('created_at', 'desc')

            ->get(['name','description','slug']);

    }


    /* =========================

       Helpers

       ========================= */


    private function normalize(Request $request): void

    {

        // input: camelCase -> snake_case

        $request->merge([

            'type'          => $request->input('type', $this->inferTypeFromTemplate($request->input('template'))),

            'hero_title'    => $request->input('hero_title',    $request->input('heroTitle')),

            'hero_subtitle' => $request->input('hero_subtitle', $request->input('heroSubtitle')),

            'about_title'   => $request->input('about_title',   $request->input('aboutTitle')),

            'about_text'    => $request->input('about_text',    $request->input('aboutText')),

            'offer_title'   => $request->input('offer_title',   $request->input('offerTitle')),

            'offer_items'   => $request->input('offer_items',   $request->input('offerItems', [])),

        ]);


        // files: camelCase -> snake_case

        if ($request->hasFile('heroImage') && !$request->hasFile('hero_image')) {

            $request->files->set('hero_image', $request->file('heroImage'));

        }

        if ($request->hasFile('aboutImage') && !$request->hasFile('about_image')) {

            $request->files->set('about_image', $request->file('aboutImage'));

        }

        // Ponuda: ponudi i offerItems[*] kao izvor za offer_items[*]

        if ($request->files->has('offerItems') && !$request->files->has('offer_items')) {

            $request->files->set('offer_items', $request->files->get('offerItems'));

        }

    }


    private function rules(string $mode = 'store'): array

    {

        $imgRule      = $mode === 'store' ? 'required|image|mimes:jpg,jpeg,png,webp|max:4096' : 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096';

        $offerImgRule = $mode === 'store' ? 'required|image|mimes:jpg,jpeg,png,webp|max:4096' : 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096';


        return [

            'type'          => 'required|in:free,pro',

            'name'          => 'required|string|max:255',

            'description'   => 'required|string|max:1000',

            'email'         => 'required|email',

            'phone'         => 'required|string|min:5|max:50',

            'facebook'      => 'nullable|url',

            'instagram'     => 'nullable|url',


            'hero_title'    => 'required|string|max:255',

            'hero_subtitle' => 'required|string|max:250',

            'hero_image'    => $imgRule,


            'about_title'   => 'required|string|max:255',

            'about_text'    => 'required|string|max:1000',

            'about_image'   => $imgRule,


            'offer_title'         => 'required|string|max:255',

            'offer_items'         => 'required|array|min:1|max:10',

            'offer_items.*.title' => 'required|string|max:255',

            'offer_items.*.image' => $offerImgRule,


            'template'      => 'required|in:klasicni,moderni,galerija,biznis,dark,klasicni-pro,moderni-pro,galerija-pro,biznis-pro,dark-pro',


            // PRO polja (samo ako se pošalju)

            'pdf_file'        => 'nullable|file|mimes:pdf|max:5120',

            'video_url'       => 'nullable|url',

            'google_map_link' => 'nullable|string|max:255',

            'address'         => 'nullable|string|max:255',

            'phone2'          => 'nullable|string|max:50',

            'phone3'          => 'nullable|string|max:50',

            'email2'          => 'nullable|email',

            'email3'          => 'nullable|email',

        ];

    }


    private function buildData(Request $request, array $v, FreeSiteRequest $existing = null): array

    {

        $store = fn($file, $folder) => $file ? $file->store("prezentacije/{$folder}", 'public') : null;


        $data = [

            'name'         => $v['name'],

            'description'  => $v['description'],

            'email'        => $v['email'],

            'phone'        => $v['phone'],

            'facebook'     => $v['facebook'] ?? null,

            'instagram'    => $v['instagram'] ?? null,

            'template'     => $v['template'],

            'type'         => $v['type'],


            'logo_path'    => $request->file('logo')

                                ? $store($request->file('logo'), 'logo')

                                : ($existing->logo_path   ?? null),


            'hero_title'   => $v['hero_title'],

            'hero_subtitle'=> $v['hero_subtitle'],

            'hero_image'   => $request->file('hero_image')

                                ? $store($request->file('hero_image'), 'hero')

                                : ($existing->hero_image  ?? null),


            'about_title'  => $v['about_title'],

            'about_text'   => $v['about_text'],

            'about_image'  => $request->file('about_image')

                                ? $store($request->file('about_image'), 'about')

                                : ($existing->about_image ?? null),


            'offer_title'  => $v['offer_title'],

        ];


        // Ponuda

        $offerItems = [];

        $incoming = $v['offer_items'] ?? [];

        foreach ($incoming as $i => $item) {

            $imgFile = $request->file("offer_items.$i.image");

            $fallbackImg = $existing->offer_items[$i]['image'] ?? null;

            $offerItems[] = [

                'title' => $item['title'] ?? '',

                'image' => $imgFile ? $store($imgFile, 'offer') : $fallbackImg,

            ];

        }

        $data['offer_items'] = $offerItems;


        // PRO (ako je pro ili su polja poslata)

        if (($v['type'] ?? 'free') === 'pro' || $request->hasAny(['pdf_file','video_url','google_map_link','address','phone2','phone3','email2','email3'])) {

            $data['pdf_file']        = $request->file('pdf_file')

                                        ? $store($request->file('pdf_file'), 'docs')

                                        : ($existing->pdf_file ?? null);

            $data['video_url']       = $request->input('video_url')       ?? ($existing->video_url       ?? null);

            $data['google_map_link'] = $request->input('google_map_link') ?? ($existing->google_map_link ?? null);

            $data['address']         = $request->input('address')         ?? ($existing->address         ?? null);

            $data['phone2']          = $request->input('phone2')          ?? ($existing->phone2          ?? null);

            $data['phone3']          = $request->input('phone3')          ?? ($existing->phone3          ?? null);

            $data['email2']          = $request->input('email2')          ?? ($existing->email2          ?? null);

            $data['email3']          = $request->input('email3')          ?? ($existing->email3          ?? null);

        }


        return $data;

    }


    private function inferTypeFromTemplate(?string $tpl): string

    {

        return $tpl && str_contains($tpl, '-pro') ? 'pro' : 'free';

    }

}
