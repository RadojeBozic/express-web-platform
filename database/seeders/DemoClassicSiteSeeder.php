<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FreeSiteRequest;

class DemoClassicSiteSeeder extends Seeder
{
    public function run()
    {
        $common = [
            'name' => 'Demo Klasični',
            'description' => 'Ovo je demo prezentacija klasičnog šablona.',
            'email' => 'demo@example.com',
            'phone' => '+381 60 123 4567',
            'facebook' => 'https://facebook.com/demo',
            'instagram' => 'https://instagram.com/demo',
            'logo_path' => null,
            'hero_title' => 'Dobrodošli u Demo',
            'hero_subtitle' => 'Savršeno mesto za početak.',
            'hero_image' => null,
            'about_title' => 'O našem demo timu',
            'about_text' => 'Mi smo demo firma sa ciljem da pokažemo izgled sajta.',
            'about_image' => null,
            'offer_title' => 'Naša ponuda',
            'offer_items' => [
                [
                    'title' => 'Demo usluga 1',
                    'image' => null,
                ],
                [
                    'title' => 'Demo usluga 2',
                    'image' => null,
                ],
            ],
            'user_id' => null,
        ];

        // FREE
        FreeSiteRequest::updateOrCreate(
            ['slug' => 'demo-klasicni-free'],
            array_merge($common, [
                'slug' => 'demo-klasicni-free',
                'template' => 'klasicni',
                'type' => 'free',
                'status' => 'active',
            ])
        );

        // PRO
        FreeSiteRequest::updateOrCreate(
            ['slug' => 'demo-klasicni-pro'],
            array_merge($common, [
                'slug' => 'demo-klasicni-pro',
                'template' => 'klasicni-pro',
                'type' => 'pro',
                'status' => 'pending',
                'pdf_file' => null,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'google_map_link' => 'https://maps.google.com/?q=Beograd',
                'address' => 'Ulica Demo 123, Beograd',
                'phone2' => '+381 11 222 3333',
                'phone3' => null,
                'email2' => 'info@demo.com',
                'email3' => null,
            ])
        );

        // PRO – Aktivirano
        FreeSiteRequest::updateOrCreate(
            ['slug' => 'demo-klasicni-active'],
            array_merge($common, [
                'slug' => 'demo-klasicni-active',
                'template' => 'klasicni-pro',
                'type' => 'pro',
                'status' => 'active',
                'pdf_file' => null,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'google_map_link' => 'https://maps.google.com/?q=Demo+Active',
                'address' => 'Demo aktivna adresa',
                'phone2' => '+381 60 000 111',
                'email2' => 'kontakt@demo.rs',
            ])
        );
    }
}
