<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Score;
use App\OtherPrediction;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Team;

class OtherPredictionController extends Controller
{
    public function index()
    {
        $position = Score::getPlayerRankings(Auth::user());
        $otherPredictions = OtherPrediction::all()->map(function($otherPrediction){
            $otherPrediction->user = User::find($otherPrediction->user_id);
            $otherPrediction->tmd = Team::find($otherPrediction->top_scoring_team);
            $otherPrediction->tmtd = Team::find($otherPrediction->most_goals_against_team);
            
            return $otherPrediction;
        });

        return view('overige', compact(
            'position',
            'otherPredictions'
        ));
    }
}
