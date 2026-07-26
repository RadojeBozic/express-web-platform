<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::orderBy('created_at', 'desc')->get();
    }
    public function changeRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        // Ne diraj superadmina!
        if ($user->role === 'superadmin') {
            return response()->json(['message' => 'Ne možete menjati superadmina.'], 403);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Uloga promenjena.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'superadmin') {
            return response()->json(['message' => 'Ne možete obrisati superadmina.'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Korisnik obrisan.']);
    }

}
