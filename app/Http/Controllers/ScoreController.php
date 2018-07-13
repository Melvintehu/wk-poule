<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Score;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Match;
use App\Team;

class ScoreController extends Controller
{

    public function index()
    {   
        // update match data
        // Match::updateMatchesData();

        // calculate team scores
        Team::recalculate();

        // calculate the scores for each toto player
        Score::recalculate();


        $position = Score::getPlayerRankings(Auth::user());
        

        $scores = Score::all()->sortByDesc('score');
        $scores = $scores->map(function($score) {
            $score->user = User::find($score->user_id);
            $score->position = Score::getPlayerRankings($score->user);
            return $score;
        });

    
        return view('stand', compact(
            'position',
            'scores'
        ));
    }
}
