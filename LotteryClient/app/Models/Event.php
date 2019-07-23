<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    protected $fillable = [
        'id',
        'winner_card_id',
        'start_date',
        'start_time',
        'card_price',
        'award'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_events')
                    ->withPivot(['id', 'status']);
    }

    public function cards() 
    {
        return $this->hasMany(Card::class);
    }
}
