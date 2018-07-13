<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Prediction;
use Auth;
use App\Score;

class PredictionController extends Controller
{
    public function predict(Match $match) 
    {
        // dd($match);
        $position = Score::getPlayerRankings(Auth::user());
        return view('voorspelling-invoeren', compact('match', 'position'));
    }

    public function store(Request $request)
    {
        $match = Match::find($request->get('match_id'));
        $prediction = Prediction::create([
            'match_id' => $match->id,
            'user_id' => Auth::user()->id,
            'home_goals' => $request->get('home_goals'),
            'away_goals' => $request->get('away_goals'),
        ]);

        return redirect('/wedstrijd-overzicht');
    }

    public function checkPredictions()
    {
        $predictions = Prediction::all();

        $predictions->each(function($prediction) {
            if($prediction->isCorrect()) {
                $user = $prediction->user();
                
                // calculate the scores for this prediction
                


                // stores the scores for this prediction in seperate record
                



            }
        });
    }
}
