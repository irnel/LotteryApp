<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}