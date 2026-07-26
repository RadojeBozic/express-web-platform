<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlausibleController extends Controller
{
    public function query(Request $request)
    {
        $apiKey = config('services.plausible.key') ?? env('PLAUSIBLE_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'Missing PLAUSIBLE_API_KEY'], 500);
        }

        // Prosledi sve što stiže sa fronta (site_id, metrics, date_range, dimensions, filters...)
        $payload = $request->all();

        // Ako želiš da FORSIRAŠ jedan site_id iz .env:
        if (empty($payload['site_id']) && env('PLAUSIBLE_SITE_ID')) {
            $payload['site_id'] = env('PLAUSIBLE_SITE_ID');
        }

        $resp = Http::withToken($apiKey)
            ->acceptJson()
            ->post('https://plausible.io/api/v2/query', $payload);

        // Vrati originalan status i JSON iz Plausible‑a
        return response()->json($resp->json(), $resp->status());
    }
}
