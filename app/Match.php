<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

class Match extends Model
{   

    protected $appends = [
        'predicted',
        'prediction',
    ];

    protected $fillable = [
        'match_id',
        'play_date',
        'start_time',
        'end_time',
        'matchday',
        'home_team',
        'away_team',
        'home_goals',
        'away_goals',
    ];

    public static function updateMatchesData()
    {
        
        // get all the matches from the api
        $url = "http://api.football-data.org/v1/competitions/467/fixtures";
        
        $client = new Client(); //GuzzleHttp\Client
        $res = $client->request('GET', $url, [
            'headers' => [
                "X-Auth-Token" => "cc57103158104c77abe4dfe99cdcf823",
                "accepts" => "json",
                "Accept" => "application/json"
            ],
            
        ]);

        $matchesRaw = collect(json_decode($res->getBody()->getContents()));
        // create match instances
        $matches = Match::rawToEloquentMatches($matchesRaw["fixtures"]);
        
        // update existing records in the database
        return Match::updateOrInsert($matches);
    }

    public function getPredictedAttribute()
    {    
        if(Auth::user()) {
            
            return Prediction::where([
                ['user_id', Auth::user()->id],
                ['match_id', $this->id],
                ])->first() !== null;
        }
    }

    public function getPredictionAttribute() {
        if(Auth::user()) {
            return Prediction::where([
                ['user_id', Auth::user()->id],
                ['match_id', $this->id],
            ])->first();
        }
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
   
    public static function rawToEloquentMatches($rawMatches)
    {
        $rawMatches = collect($rawMatches);

        $matches = $rawMatches->map(function($rawMatch) {
            $match = new Match();

            $date = substr($rawMatch->date, 0, 10);
            $time = substr($rawMatch->date, 11, 5);
            $parts = explode("/", $rawMatch->_links->self->href);
            $match->match_id = $parts[count($parts)-1];
            $match->play_date = $date;
            $start_time = (intval(explode(":", $time)[0]) + 2) .':' . explode(":", $time)[1];

            $endTime = (intval(explode(":", $start_time)[0]) + 2) .':' . explode(":", $start_time)[1];
            // dd($endTime);
            $match->start_time = $start_time;
            $match->end_time = $endTime;
            $match->matchday = $rawMatch->matchday;
            $match->home_team = $rawMatch->homeTeamName;
            $match->away_team = $rawMatch->awayTeamName;
            $match->home_goals = $rawMatch->result->goalsHomeTeam;
            $match->away_goals = $rawMatch->result->goalsAwayTeam;
            
            
            return $match;
        });

        
        return $matches;
    }

    public static function updateOrInsert($matches)
    {   
        
        $matches->each(function($match) {
            $match = $match->toArray();
            unset($match['predicted']);
            unset($match['prediction']);
            
            
            $matchExists = Match::where('match_id', $match["match_id"])->first();
            if($matchExists != null) {
                $matchExists->play_date = $match["play_date"];
                $matchExists->start_time = $match["start_time"];
                $matchExists->end_time = $match["end_time"];
                // $matchExists->status = $match["status"];
                $matchExists->matchday = $match["matchday"];
                $matchExists->home_team = $match["home_team"];
                $matchExists->away_team = $match["away_team"];
                // $matchExists->home_goals = $match["home_goals"];
                // $matchExists->away_goals = $match["away_goals"];
                
                $matchExists->save();
            } else {    
                Match::create($match);
            }

        });
    }



    public function predictedByUser($user)
    {   
        $prediction = Prediction::where([
            ['match_id', $this->id],
            ['user_id', $user->id],
        ])->first();

        if($prediction == null) {
            $prediction = new Prediction;

            $prediction->user_id = $user->id;
            $prediction->match_id = $this->id;
        }

        return $prediction;
    }

    public static function now() 
    {
        return Match::where([
            ['play_date', Carbon::now()->format('Y-m-d')],
            ['start_time', '<=', Carbon::now()->format('H:i:s')],
            ['end_time', '>=' ,Carbon::now()->format('H:i:s')]
        ])->first();
    }   
    
    public function played()
    {

    }

    public function toBePlayed()
    {

    }
   
}
