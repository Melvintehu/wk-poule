<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamPrediction extends Model
{
    protected $fillable = [
        'team_id',
        'round_number',
        'user_id',
    ];

    public static function getTeamsInForRound($roundNumber, $user_id)
    {
        return TeamPrediction::where([
            ['round_number', $roundNumber],
            ['user_id', $user_id],
        ])->get();
    }
    

}
