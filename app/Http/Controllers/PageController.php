<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Score;
use Illuminate\Support\Facades\Auth;
use App\OtherPrediction;
use App\Team;

class PageController extends Controller
{
    public function topScorer()
    {   

        if(OtherPrediction::predictedTopScorer()) {
            return redirect()->back();
        }

        $position = Score::getPlayerRankings(Auth::user());
        
        return view('top-scorer', compact(
            'position'
        ));
    }

    public function topScoringTeam()
    {
        
        if(OtherPrediction::predictedTopScoringTeam()) {
            return redirect()->back();
        }

        $position = Score::getPlayerRankings(Auth::user());
        $teams = Team::all();
        return view('topScoringTeam', compact(
            'position',
            'teams'
        ));
    }

    public function mostGoalsAgainstTeam()
    {
        
        if(OtherPrediction::predictedMostGoalsAgainstTeam()) {
            return redirect()->back();
        }

        $position = Score::getPlayerRankings(Auth::user());
        $teams = Team::all();
        return view('mostGoalsAgainstTeam', compact(
            'position',
            'teams'
        ));
    }

    public function insertTopScorer(Request $request)
    {
        
        OtherPrediction::setTopScorer($request->get('topScorer'));

        return redirect('/wedstrijd-overzicht');
    }

    public function insertMostGoalsAgainstTeam(Request $request)
    {
        
        OtherPrediction::setMostGoalsAgainstTeam($request->get('mostGoalsAgainstTeam'));

        return redirect('/wedstrijd-overzicht');
    }

    public function insertTopScoringTeam(Request $request)
    {
        
        OtherPrediction::setTopScoringTeam($request->get('topScoringTeam'));

        return redirect('/wedstrijd-overzicht');
    }
}
