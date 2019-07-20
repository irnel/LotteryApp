<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class AttributeFormat 
{
    public static function attrDate($date)
    {
        return Carbon::parse($date)->format('Y/m/d');
    }

    public static function attrCurrency($currency)
    {
        return number_format($currency, 2, '.', ',');
    }
}
