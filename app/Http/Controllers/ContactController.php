<?php


namespace App\Http\Controllers;


use App\Models\Message;

use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Validator;


class ContactController extends Controller

{

    // Ako route cache i dalje gađa store(), prosledi na submit() (da ne puca 500)

    public function store(Request $request): JsonResponse

    {

        return $this->submit($request);

    }


    /**

     * Obrada kontakt forme (API endpoint).

     */

    public function submit(Request $request): JsonResponse

    {

        try {

            $v = Validator::make($request->all(), [

                'name'       => ['required', 'string', 'max:255'],

                'email'      => ['required', 'email'],

                'message'    => ['required', 'string', 'min:5', 'max:5000'],

                'newsletter' => ['nullable', 'boolean'],

            ]);


            if ($v->fails()) {

                return response()->json([

                    'message' => 'Validacija neuspešna.',

                    'errors'  => $v->errors(),

                ], 422);

            }


            $data = $v->validated();


            // 1) SNIMI U BAZU

            $payload = [

                'name'       => $data['name'],

                'email'      => $data['email'],

                'message'    => $data['message'],

                'newsletter' => (bool)($data['newsletter'] ?? false),

            ];


            // (opciono) ako u tabelu dodaš user_id kolonu, upiši i nju

            if (Schema::hasColumn('messages', 'user_id')) {

                $payload['user_id'] = optional($request->user())->id;

            }


            Message::create($payload);


            // 2) MAIL (best-effort — ne obara zahtev ako padne)

            try {

                $body  = "Ime: {$data['name']}\n";

                $body .= "Email: {$data['email']}\n";

                $body .= "Newsletter: " . (!empty($data['newsletter']) ? 'DA' : 'NE') . "\n\n";

                $body .= "Poruka:\n{$data['message']}\n";


                Mail::raw($body, function ($m) {

                    $to = config('mail.from.address') ?: 'hello@example.com';

                    $m->to($to)->subject('Kontakt forma — ExpressAjt');

                });

            } catch (\Throwable $mailErr) {

                try { Log::warning('Kontakt mejl nije poslat: '.$mailErr->getMessage()); } catch (\Throwable $e) {}

            }


            return response()->json([

                'message' => 'Poruka je uspešno poslata.',

                'data'    => [

                    'name'       => $data['name'],

                    'email'      => $data['email'],

                    'newsletter' => (bool)($data['newsletter'] ?? false),

                ],

            ], 201);


        } catch (\Throwable $e) {

            try { Log::error('Kontakt greška', ['ex' => $e]); } catch (\Throwable $ignore) {}

            return response()->json(['message' => 'Greška na serveru.'], 500);

        }

    }

}
