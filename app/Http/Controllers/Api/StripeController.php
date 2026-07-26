<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'currency' => 'string|in:eur,usd',
            'description' => 'nullable|string',
            'token' => 'required|string',
            'plan' => 'nullable|string',
        ]);

        $stripeSecret = config('services.stripe.secret');

        $response = Http::withToken($stripeSecret)
            ->asForm()
            ->post('https://api.stripe.com/v1/charges', [
                'amount' => $request->amount,
                'currency' => $request->currency ?? 'eur',
                'source' => $request->token,
                'description' => $request->description ?? 'ExpressWeb plaćanje',
            ]);

        if (!$response->successful()) {
            return response()->json(['error' => 'Stripe naplata nije uspela.'], 500);
        }

        $charge = $response->json();

        // ✅ Snimamo u bazu
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'stripe_id' => $charge['id'],
            'amount' => $charge['amount'],
            'currency' => $charge['currency'],
            'status' => $charge['status'],
            'description' => $request->description,
            'plan' => $request->plan ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Plaćanje uspešno!',
            'charge' => $charge
        ]);
    }
}
