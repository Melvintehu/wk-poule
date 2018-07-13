<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'user_id',
        'match_id',
        'home_goals',
        'away_goals',
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getPointsForTeam($team)
    {
        // perspective is from home team
        $goalDifferenceActualGame = $this->home_goals - $this->away_goals; // 0 
        $actualGameWin = $goalDifferenceActualGame > 0; // false
        $actualGameLose = $goalDifferenceActualGame < 0; // false
        $actualGameDraw = $goalDifferenceActualGame == 0; // true

        // decide if the prediction matches the actual outcome of the game.
        if( ($actualGameWin && $this->home_team == $team->name) || ($actualGameLose && $this->away_team == $team->name ) ) {
            return 3;
        }

        if($actualGameDraw) {
            return 1;
        }

        return 0;
    }
}
