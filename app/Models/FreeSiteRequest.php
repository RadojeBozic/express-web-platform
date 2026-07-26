<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class FreeSiteRequest extends Model

{

    use HasFactory;


    protected $fillable = [

        // osnovno

        'user_id','name','description','email','phone','facebook','instagram',

        'logo_path','template','slug','type','plan','status',

        // hero

        'hero_title','hero_subtitle','hero_image',

        // about

        'about_title','about_text','about_image',

        // ponuda

        'offer_title','offer_items',

        // pro dodatno

        'google_map_link','pdf_file','video_url','address',

        'phone2','phone3','email2','email3',

    ];


    protected $casts = [

        'offer_items' => 'array',

    ];

}
