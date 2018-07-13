<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamPrediction;
use Illuminate\Support\Facades\Auth;
use App\Team;
use Carbon\Carbon;
use App\Score;
use App\User;

class TeamPredictionController extends Controller
{
    
    public function getRoundPredictions()
    {   
        $dates = collect([
            2 => ["startDate" => "2018-06-13 00:00:00", "endDate" => "2018-06-14 23:59:00", "roundNumber" => 2, "name" => "poule fase"], // voorspelling 8ste finale
            3 => ["startDate" => "2018-06-15 00:00:00", "endDate" => "2018-06-29 23:59:00", "roundNumber" => 2, "name" => "achtste finales"], // voorspelling kwart finale
            4 => ["startDate" => "2018-06-30 00:00:00", "endDate" => "2018-07-05 23:59:00", "roundNumber" => 3, "name" => "kwartfinales"], // voorspelling halve finale
            5 => ["startDate" => "2018-07-06 00:00:00", "endDate" => "2018-07-10 19:59:59", "roundNumber" => 4, "name" => "halvefinales"], // voorspelling troost finale
            6 => ["startDate" => "2018-07-06 00:00:00", "endDate" => "2018-07-10 19:59:59", "roundNumber" => 5, "name" => "troostfinale"], // voorspelling finale
            7 => ["startDate" => "2018-07-10 19:59:59", "endDate" => "2018-07-14 15:59:59", "roundNumber" => 6, "name" => "finale"], // voorspelling finale winnaar
        ]);

        $currentRound = null;

        foreach($dates as $roundNumber => $roundData) 
        {   

            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $roundData["startDate"]);
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $roundData["endDate"]);
            $currentDate = Carbon::now();
            
            if($currentDate->gte($startDate) && $currentDate->lte($endDate) ) {
                $currentRound = $roundData;
                
                break;
            }
        }
        
        $users = User::all()->map(function($user) use ($currentRound, $startDate) {
        
            $user->teamPredictions = TeamPrediction::where([
                ['user_id', $user->id],
                ['round_number', $currentRound['roundNumber']]
            ])->get()->map(function($teamPrediction) use ($startDate){
                $teamPrediction->team = Team::find($teamPrediction->team_id);
                $teamPrediction->eliminted = false;

                return $teamPrediction;
            });
            
            return $user;
        });

        $position = Score::getPlayerRankings(Auth::user());



        return view('roundPredictions', compact(
            'position',
            'users',
            'currentRound'
        ));

    }

    public function insertPredictions(Request $request)
    {
        
        $position = Score::getPlayerRankings(Auth::user());
        $dates = collect([
            2 => ["startDate" => "2018-06-13 00:00:00", "endDate" => "2018-06-14 23:59:00", "roundNumber" => 2], // voorspelling 8ste finale
            3 => ["startDate" => "2018-06-15 00:00:00", "endDate" => "2018-06-29 23:59:00", "roundNumber" => 3, "name" => "achtste finales"], // voorspelling kwart finale
            4 => ["startDate" => "2018-06-30 00:00:00", "endDate" => "2018-07-06 15:59:00", "roundNumber" => 4, "name" => "kwartfinales"], // voorspelling halve finale
            5 => ["startDate" => "2018-07-06 15:59:00", "endDate" => "2018-07-10 19:59:59", "roundNumber" => 5, "name" => "halvefinales"], // voorspelling troost finale
            6 => ["startDate" => "2018-07-06 15:59:00", "endDate" => "2018-07-10 19:59:59", "roundNumber" => 6, "name" => "troostfinale"], // voorspelling finale
            7 => ["startDate" => "2018-07-11 23:00:00", "endDate" => "2018-07-14 15:59:59", "roundNumber" => 7, "name" => "finale"], // voorspelling finale winnaar
        ]);

        $currentRound = null;

        foreach($dates as $roundNumber => $roundData) 
        {   

            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $roundData["startDate"]);
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $roundData["endDate"]);
            $currentDate = Carbon::now();
            // $currentDate = Carbon::createFromFormat('Y-m-d', "2018-06-30");

            
            if($currentDate->gte($startDate) && $currentDate->lte($endDate) ) {
                $currentRound = $roundData;
                
                break;
            }
        }

        
        
        $predictedTeams = collect($request->all())->filter(function($teamPrediction, $key) {
            // filter the teams

            if(substr($key, 0, 4) == "team"){
                return true;
            }
        })->each(function($teamPrediction, $key) use($currentRound) {
            
            if($currentRound["roundNumber"] == 5) {
                $parts = explode("-",$teamPrediction);
                $team = $parts[0];
                
                $finalOrComfort = $parts[1];

                if($finalOrComfort == "t") {
                    TeamPrediction::create([
                        'team_id' => $team,
                        'round_number' => $currentRound["roundNumber"],
                        'user_id' => Auth::user()->id, 
                    ]);
                    
                } else if($finalOrComfort == "f") {
                    TeamPrediction::create([
                        'team_id' => $team,
                        'round_number' => 6,
                        'user_id' => Auth::user()->id, 
                    ]);
                }


            } else if(true) {
             

                if($key == 'team1') {
                    TeamPrediction::create([
                        'team_id' => $teamPrediction,
                        'round_number' => 8,
                        'user_id' => Auth::user()->id, 
                    ]);
                } else if($key == 'team2') {
                    TeamPrediction::create([
                        'team_id' => $teamPrediction,
                        'round_number' => 7,
                        'user_id' => Auth::user()->id, 
                    ]);
                }
                    
               


            } else {

                TeamPrediction::create([
                    'team_id' => $teamPrediction,
                    'round_number' => $currentRound["roundNumber"],
                    'user_id' => Auth::user()->id, 
                ]);
            }
        });
        
        return redirect('/stand');
    }

    public function getRound()
    {
        $position = Score::getPlayerRankings(Auth::user());

        
        $dates = collect([
            2 => ["startDate" => "2018-06-13 00:00:00", "endDate" => "2018-06-14 23:59:59", "roundNumber" => 2 , "view" => "ronde1"], // voorspelling 8ste finale
            3 => ["startDate" => "2018-06-15 00:00:00", "endDate" => "2018-06-30 15:59:59", "roundNumber" => 3, "view" => "ronde2"], // voorspelling kwart finale
            4 => ["startDate" => "2018-06-30 16:00:00", "endDate" => "2018-07-06 15:59:59", "roundNumber" => 4, "view" => "ronde3"], // voorspelling halve finale
            5 => ["startDate" => "2018-07-06 15:59:00", "endDate" => "2018-07-10 19:59:59", "roundNumber" => 5, "view" => "ronde4" ], // voorspelling troost finale
            6 => ["startDate" => "2018-07-06 00:00:00", "endDate" => "2018-07-10 19:59:59", "roundNumber" => 6, "view" => "ronde4"], // voorspelling finale
            7 => ["startDate" => "2018-07-10 19:59:00", "endDate" => "2018-07-14 23:59:59", "roundNumber" => 7, "view" => "toernooi-winnaar"], // voorspelling finale winnaar
        ]);

        foreach($dates as $roundNumber => $roundData) 
        {   

            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $roundData["startDate"]);
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $roundData["endDate"]);
            $currentDate = Carbon::now();
            

            if($currentDate->gte($startDate) && $currentDate->lte($endDate) ) {
                
                // check if the toto player has allready predicted this round
                $teamPredictions = TeamPrediction::where([
                    ['user_id', Auth::user()->id],
                    ['round_number', $roundData["roundNumber"]]
                ])->get();

                

                if(count($teamPredictions) > 0) {
                    return view('team-voorspellingen.al-ingevuld', compact('position'));
                }

                // get the teams for round 6 also because they are at the same time
                if($roundData["roundNumber"] == 5) {

                    $comfortFinalTeams = Team::teamsEligibleForNextRound($roundData["roundNumber"]);
                    $finalTeams = Team::teamsEligibleForNextRound(6);

                    // return custom view here
                    return view('team-voorspellingen/ronde5en6', compact(
                        'comfortFinalTeams',
                        'finalTeams',
                        'position'
                    ));
                }
                
                // get the teams for round 6 also because they are at the same time
                if($roundData["roundNumber"] == 7) {
                    $comfortFinalTeams = Team::teamsEligibleForNextRound(6);
                    $finalTeams = Team::teamsEligibleForNextRound(7);

                    // return custom view here
                    return view('team-voorspellingen/toernooi-winnaar', compact(
                        'comfortFinalTeams',
                        'finalTeams',
                        'position'
                    ));
                }
                
                
                $teams = Team::teamsEligibleForNextRound($roundData['roundNumber']);
        
                return view('team-voorspellingen/' . $roundData['view'] , compact('teams', 'position'));
                break;
            }
        }
        // find predictions
        
        
        
         



    }

    public function savePrediction()
    {

    }
}
