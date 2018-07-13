<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OtherPrediction extends Model
{
    protected $fillable = [
        'top_scorer',
        'top_scoring_team',
        'most_goals_against_team',
        'user_id',
    ];


    public static function predictedTopScorer()
    {
        $user = Auth::user();

        $otherPrediction = OtherPrediction::where('user_id', $user->id)->first();

        if($otherPrediction != null) {
            if($otherPrediction->top_scorer != null) {
                return true;
            }
        }

        return false;
    }

    public static function predictedTopScoringTeam()
    {
        $user = Auth::user();

        $otherPrediction = OtherPrediction::where('user_id', $user->id)->first();

        if($otherPrediction != null) {
            if($otherPrediction->top_scoring_team != null) {
                return true;
            }
        }

        return false;
    }

    public static function predictedMostGoalsAgainstTeam()
    {
        $user = Auth::user();

        $otherPrediction = OtherPrediction::where('user_id', $user->id)->first();

        if($otherPrediction != null) {
            if($otherPrediction->most_goals_against_team != null) {
                return true;
            }
        }

        return false;
    }

    public static function setTopScorer($name) 
    {
        $user = Auth::user();

        $otherPrediction = OtherPrediction::where('user_id', $user->id)->first();

        if($otherPrediction == null) {
            $otherPrediction = new OtherPrediction();
            $otherPrediction->user_id = $user->id;
        }

        $otherPrediction->top_scorer = $name;
        $otherPrediction->save();
    }

    public static function setTopScoringTeam($name) 
    {
        $user = Auth::user();

        $otherPrediction = OtherPrediction::where('user_id', $user->id)->first();

        if($otherPrediction == null) {
            $otherPrediction = new OtherPrediction();
            $otherPrediction->user_id = $user->id;
        }

        $otherPrediction->top_scoring_team = $name;
        $otherPrediction->save();
    }

    public static function setMostGoalsAgainstTeam($name) 
    {
        $user = Auth::user();

        $otherPrediction = OtherPrediction::where('user_id', $user->id)->first();
      
        if($otherPrediction == null) {
            $otherPrediction = new OtherPrediction();
            $otherPrediction->user_id = $user->id;
        }

        $otherPrediction->most_goals_against_team = $name;
        $otherPrediction->save();
    }
}
