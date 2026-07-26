<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use App\Models\Message;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;


class MessageController extends Controller

{

    /** POST /api/messages */

    public function store(Request $request)

    {

        $data = $request->validate([

            'name'       => 'required|string|max:100',

            'email'      => 'required|email|max:150',

            'message'    => 'required|string',

            'newsletter' => 'sometimes|boolean',

        ]);


        $payload = [

            'name'       => $data['name'],

            'email'      => $data['email'],

            'message'    => $data['message'],

            'newsletter' => (bool)($data['newsletter'] ?? false),

        ];


        // Ako kolona postoji, veži poruku za ulogovanog korisnika

        if (Schema::hasColumn('messages', 'user_id')) {

            $payload['user_id'] = optional($request->user())->id;

        }


        $msg = Message::create($payload);


        return response()->json([

            'message' => 'Poruka uspešno sačuvana.',

            'data'    => $msg,

        ], 201);

    }


    /** GET /api/messages (admin listing ako želiš ograničiti) */

    public function index()

    {

        return Message::orderBy('created_at', 'desc')->get();

    }


    /** DELETE /api/messages/{id} */

    public function destroy($id)

    {

        $message = Message::findOrFail($id);

        $message->delete();


        return response()->json(['message' => 'Poruka obrisana.']);

    }


    /** GET /api/my-messages (auth) */

    public function mine(Request $request)

    {

        $user = $request->user();

        if (!$user) return response()->json([], 200);


        $q = Message::query()->latest();


        if (Schema::hasColumn('messages', 'user_id')) {

            // Grupisano: (user_id = ja) OR (user_id is null AND email = moj)

            $q->where(function ($qq) use ($user) {

                $qq->where('user_id', $user->id)

                   ->orWhere(function ($qq2) use ($user) {

                       $qq2->whereNull('user_id')->where('email', $user->email);

                   });

            });

        } else {

            // Fallback kad nema kolone user_id: filtriraj po email-u

            $q->where('email', $user->email);

        }


        return response()->json($q->get());

    }

}
