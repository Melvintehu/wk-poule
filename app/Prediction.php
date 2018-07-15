<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Prediction extends Model
{
    protected $guarded = [];

    public static function predict(array $array, $match)
    {
        $array = array_merge($array, [
            'user_id' => Auth::user()->id,
            'match_id' => $match->id
        ]);
        
        return Self::create($array);
    }
    
}
