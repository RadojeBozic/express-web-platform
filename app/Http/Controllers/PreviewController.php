<?php


namespace App\Http\Controllers;


use App\Models\FreeSiteRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\View\View;


class PreviewController extends Controller

{

    public function show(string $slug): View

    {

        $data = FreeSiteRequest::where('slug', $slug)->firstOrFail();


        // Helper: relativna putanja => javni URL (ili pusti apsolutne kako jesu)

        $toUrl = function (?string $path) {

            if (!$path) return null;

            if (preg_match('/^https?:\/\//i', $path)) return $path;

            // osiguraj ltrim da ne dupliramo “/storage/”

            return Storage::disk('public')->url(ltrim($path, '/'));

        };


        $media = [

            'logo'  => $toUrl($data->logo_path),

            'hero'  => $toUrl($data->hero_image),

            'about' => $toUrl($data->about_image),

            'pdf'   => $toUrl($data->pdf_file),

        ];


        $offerImages = collect($data->offer_items ?? [])

            ->map(function ($it) use ($toUrl) {

                return [

                    'title' => (string)($it['title'] ?? ''),

                    'image' => $toUrl($it['image'] ?? null),

                ];

            })

            ->filter(fn ($it) => !empty($it['image']))

            ->values()

            ->all();


        return view('preview', compact('data', 'media', 'offerImages'));

    }

}
