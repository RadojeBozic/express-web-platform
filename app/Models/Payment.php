<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'stripe_id',
        'amount',
        'currency',
        'status',
        'description',
        'plan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
