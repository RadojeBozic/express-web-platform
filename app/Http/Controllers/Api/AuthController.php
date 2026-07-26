<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Registracija novog korisnika
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'message' => 'nullable|string',
            'referrer' => 'nullable|string',
            'role' => 'nullable|in:superadmin,user',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'message' => $fields['message'] ?? null,
            'referrer' => $fields['referrer'] ?? null,
            'role' => $fields['role'] ?? ($fields['email'] === 'admin@example.com' ? 'superadmin' : 'user'),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Prijava korisnika
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Uneti podaci nisu ispravni.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Dohvatanje trenutno prijavljenog korisnika
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Odjava korisnika (brisanje svih tokena)
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Uspešno ste se odjavili.']);
    }

    /**
     * Brisanje korisničkog naloga (samobrisanje)
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        if (in_array($user->role, ['admin', 'superadmin'])) {
            return response()->json([
                'message' => 'Admin i SuperAdmin nalozi ne mogu biti obrisani ovom metodom.'
            ], 403);
        }

        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message' => 'Vaš nalog je uspešno obrisan.'], 200);
    }
}
