<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Matchday;
use App\Score;
use App\Team;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class MatchController extends Controller
{

    public function predictions()
    {   
        // get the current match
        $match = Match::now();
        // $match = Match::find(11);
        if($match != null) {    
            $predictions = User::all()->map(function($user) use ($match){
                $prediction = $match->predictedByUser($user);
                $prediction->user = $user;
                return $prediction;
            });
            
        }

        $position = Score::getPlayerRankings(Auth::user());
        return view('predictions.now', compact('predictions', 'position', 'match'));
            
    }



    public function index()
    {
        // update match data
        // Match::updateMatchesData();

        // calculate team scores
        Team::recalculate();

        // calculate the scores for each toto player
        Score::recalculate();

        // get the matches
        $matches = Match::where([
            ['home_team',  '!=',  ""],
            ['play_date', '>', Carbon::now()->format('Y-m-d')]
        ])->orWhere([
            ['home_team', '!=', ""],
            ['play_date', '=' , Carbon::now()->format('Y-m-d')],
            ['end_time', '>=' , Carbon::now()->format("H:i:s")]
        ])->get();
        
        // dd($matches);
        // remove matches that have been played
        
        $matchdays = Matchday::all();
        $position = Score::getPlayerRankings(Auth::user());


        // check which matches should be locked
        
        $matches = $matches->map(function($match) {
            $date = Carbon::createFromFormat('Y-m-d', $match->play_date)->format("d-m-Y");
            
            $match->play_date = $date;
           
            $start_time = Carbon::createFromFormat("d-m-Y H:i:s", $match->play_date . ' ' . $match->start_time);
            // $start_time->addHours(2);

            $currentTime = Carbon::now();

            if($start_time->lte($currentTime) ) {
                $match->locked = false;
            } else {
                $match->locked = false;
            }
            
            return $match;
        });


        return view('wedstrijd-overzicht', compact(
            'matchdays',
            'matches',
            'position'
        ));
    }


    public function played()
    {
        // update match data
        // Match::updateMatchesData();

        // calculate team scores
        Team::recalculate();

        // calculate the scores for each toto player
        Score::recalculate();

        // get the matches
        $matches = Match::where([
            ['home_team',  '!=',  ""],
            ['play_date', '<', Carbon::now()->format('Y-m-d')]
        ])->orWhere([
            ['home_team', '!=', ""],
            ['play_date', '=' , Carbon::now()->format('Y-m-d')],
            ['end_time', '<=' , Carbon::now()->format("H:i:s")]
        ])->get();
        
        $matchdays = Matchday::all();
        $position = Score::getPlayerRankings(Auth::user());


        // check which matches should be locked
        
        $matches = $matches->map(function($match) {
            $date = Carbon::createFromFormat('Y-m-d', $match->play_date)->format("d-m-Y");
            
            $match->play_date = $date;
           
            $start_time = Carbon::createFromFormat("d-m-Y H:i:s", $match->play_date . ' ' . $match->start_time);

            $currentTime = Carbon::now();

            if($start_time->lte($currentTime) ) {
                $match->locked = true;
            } else {
                $match->locked = false;
            }
            
            return $match;
        });


        return view('wedstrijd-overzicht', compact(
            'matchdays',
            'matches',
            'position'
        ));
    }
}
