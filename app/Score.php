<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Score extends Model
{

    public function getColorCode()
    {
        // 96, 201, 129 this is the secondary color of the app
        $temp = round(12.56 * $this->position[0] - 1);
        $temp2 = round(9.9 * $this->position[0] - 1);
        $temp3 = round(8.0625 * $this->position[0] - 1);


        $blue = 129 - $temp3; // 16, 0
        $red = 96 + $temp2; // 16, 255
        $green = 201 - $temp; // 16 , 0

        
        
        return "rgb(". $red . "," . $green . ", " . $blue . ")";
    }
    
    protected $fillable = [
        'user_id',
        'score',
        'correct_match_outcomes',
        'correct_match_scores',
        'teams_to_next_round',
        'correct_top_scorer',
        'correct_team_with_most_goals',
        'correct_team_with_most_goals_against',
    ];
    
    public static function resetScore($user)
    {

        $score = Static::getScoreForUser($user);
        $score->score = 0;
        $score->correct_match_outcomes = 0;
        $score->correct_match_scores = 0;
        $score->teams_to_next_round = 0;
        $score->correct_top_scorer = 0;
        $score->correct_team_with_most_goals = 0;
        $score->correct_team_with_most_goals_against = 0;
   
        return $score;
    }


    public static function getPlayerRankings($user) 
    {
        
        $scores = Score::all()->sortByDesc('score');
  
        $playerScore = Score::where('user_id', $user->id)->first();
        $position = 1;

        foreach($scores as $score) {
            if($playerScore->id == $score->user_id ) {
                break;
            } 
            $position++;

        }
        
        return [$position, count($scores)];
        

    }

    public static function getScoreForUser($user)
    {
        $score = static::where('user_id', $user->id)->first();
        if($score == null) {
            $score = new Score();

            $score->user_id = $user->id;
            return $score;
        }

        return $score;
    }


    public static function recalculate()
    {
        // get all the users
        $users = User::all();
        
        // calculate the score for each user
        $users->each(function($user) {
            
            // reset the score
            $score = Static::resetScore($user);
            
            // get all the matches that have been played
            $date = Carbon::now()->format("Y-m-d");

            // wheren player_date and home goals not null
            $matches = Match::where([
                ['play_date', '<', $date],
            ])->orWhere([
                ['play_date', '=', $date],
                ['end_time', '<', Carbon::now()->format("H:i:s")]
            ])->get();
            
           
            // calculate the total score for each match and sum it
            $score->score = $matches->reduce(function($carry, $match) use ($user, $score) {
               

                    $prediction = Prediction::where([
                        ['match_id', $match->id],
                        ['user_id', $user->id],
                    ])->first();
                    
                    $totalPoints = 0;
                    // check if the player has predicted this match
                    if($prediction != null) {

                        
                        
                        // each function updates some attributes of the score
                        $totalPoints += Score::checkCorrectMatchOutcome($match, $prediction, $score); // updates the total correct_match_outcomes of the score
                        $totalPoints += Score::checkCorrectMatchScore($match, $prediction, $score); // updates the total correct_match_scores of the score
                        
                        
                    }
                    
                    
                    
                    return $carry + $totalPoints;
                
            }, 0);
            
            $score->score += Score::checkTeamsArrivedInNextRound($score, $user); 
            // save the recalculated score
            $score->save();
            
           
        });
        
    }

  

    // 3 punten per goed voorspelde toto. 
    public static function checkCorrectMatchOutcome($match, $prediction, $score)
    {        
        // perspective is from home team
        
        $goalDifferencePrediction = $prediction->home_goals - $prediction->away_goals;  // 0
        $predictionWin = $goalDifferencePrediction > 0; // false
        $predictionLose = $goalDifferencePrediction < 0; // false
        $predictionDraw = $goalDifferencePrediction == 0; // true
        // perspective is from home team
        $goalDifferenceActualGame = $match->home_goals - $match->away_goals; // 0 
        $actualGameWin = $goalDifferenceActualGame > 0; // false
        $actualGameLose = $goalDifferenceActualGame < 0; // false
        $actualGameDraw = $goalDifferenceActualGame == 0; // true
        
        // decide if the prediction matches the actual outcome of the game.
        if($actualGameWin == $predictionWin && $actualGameLose == $predictionLose && $actualGameDraw == $predictionDraw) {
            $score->correct_match_outcomes += 1;

            return 3;
        }

        return 0;
        
    }
    
    // 5 punten voor correct uitslag
    public static function checkCorrectMatchScore($match, $prediction, $score) 
    {
        if($match->home_goals == $prediction->home_goals && $match->away_goals == $prediction->away_goals) {
            $score->correct_match_scores += 1;
            return 5;
        }
        return 0;
    }
    
    // 8 punten per correct voorspeld team in de eindklassering in de poulefase. 
    public static function checkTeamsArrivedInNextRound($score, $user) 
    {
        // dates of the different rounds
        $dates = collect([
            "2018-06-29" => 2,
            "2018-07-04" => 3,
            "2018-07-08" => 4,
            "2018-07-12" => 5,
            "2018-07-16" => 6,
            "2018-07-16" => 7
        ]);
        

        $dates->each(function($roundNumber, $date) use($user, $score) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            
            // calculate the score for each round
            if($date->isPast()) {
                
                $teamsPredicted = TeamPrediction::getTeamsInForRound($roundNumber, $user->id);
                $teamsActual = Team::teamsInRound($roundNumber);

                // dd($teamsPredicted, $teamsActual);
                $score->score += $teamsPredicted->reduce(function($carry, $team) use ($teamsActual, $score){
                    
                    if($teamsActual->contains('name', Team::find($team->team_id)->name)) {
                        
                        $score->teams_to_next_round += 1;
                        
                        return $carry + 8;
                    }

                    return $carry + 0;
                });

                
            }
        });
    }
    
    // Bonusvraag: Topscoorder 20 punten.
    public function checkTopScorer() {}
        
    // Meeste goals voor: 20 punten 
    public function checkTeamWithMostScoredGoals() {}
    
    // Meestel goals tegen: 20 punten
    public function checkTeamWithMostGoalsAgainst(){}
                
                
}
            