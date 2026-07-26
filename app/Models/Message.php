<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class Message extends Model

{

    use HasFactory;


    // Tabela: messages (podrazumevano)


    protected $fillable = [

        'name',

        'email',

        'message',

        'newsletter',

        'user_id', // ako kasnije dodaš ovu kolonu, samo je odkomentariši

    ];


    protected $casts = [

        'newsletter' => 'boolean',

        // 'meta' => 'array', // ako ikad dodaš json meta kolonu

    ];


    // Relacija (radi tek kada dodaš user_id kolonu)

    public function user()

    {

        return $this->belongsTo(User::class);

    }

}
