<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Foundation\Console\PackageDiscoverCommand;
use Illuminate\Support\Carbon;

class Team extends Model
{   

    protected $fillable = [
        'name',
        'score',
        'team_id',
        'goals_for',
        'goals_against',
        'position',
    ];

    
    public static function updateTeamData()
    {
        
        // get all the teams from the api
        $url = "http://api.football-data.org/v1/competitions/467/teams";
        
        $client = new Client(); //GuzzleHttp\Client
        $res = $client->request('GET', $url, [
            'headers' => [
                "X-Auth-Token" => "cc57103158104c77abe4dfe99cdcf823",
                "accepts" => "json",
                "Accept" => "application/json"
            ],
        ]);

        $teamsRaw = collect(json_decode($res->getBody()->getContents()));    
        $teams = static::rawToEloquentTeams($teamsRaw['teams']);
        
        Team::updateOrInsert($teams);
    }

    public static function rawToEloquentTeams($teamsRaw)
    {
        $teamsRaw = collect($teamsRaw);
        $teams = $teamsRaw->map(function($rawTeam) {
            $team = new Team();

            $team->name = $rawTeam->name;
            $parts = explode("/", $rawTeam->_links->self->href);
            $team->team_id = $parts[count($parts)-1];
            return $team;
        });

        return $teams;
    }

    public static function recalculate()
    {
        $matches = Match::whereNotNull('home_goals')->get();
        Team::all()->each(function($team) use ($matches){
            // calculate team score
            
            $team->score = $matches->reduce(function($carry, $match) use ($team) {
                
                if($match->home_team == $team->name || $match->away_team == $team->name) {
                    return $carry + $match->getPointsForTeam($team);
                }

                return $carry + 0;
            });

            
            $team->save();
        }, 0);
        
        Team::updateGoals();
    }

    public static function updateGoals()
    {
        Team::all()->each(function($team){
            // reset goals stats
            $team->goals_for = 0;
            $team->goals_against = 0;
            
            // find all the matches this team has played
            $played_matches = Match::where('home_team', $team->name)->orWhere('away_team', $team->name)->get();
         
                
            // assign the goals from all the home matches
            $played_matches->where('home_team', $team->name)->each(function($match) use ($team){
                $team->goals_for += $match->home_goals;
                $team->goals_against += $match->away_goals;
            });

            // assign the goals from all the away matches
            $played_matches->where('away_team', $team->name)->each(function($match) use ($team) {
                $team->goals_for += $match->away_goals;
                $team->goals_against += $match->home_goals;
            });
            
            // save the team and iterate over the next team
            $team->save();
        });
    }


    public function isEliminated($startDate) 
    {   

        $currentDate = Carbon::now();
        
        $match = Match::where([
            ['home_team', $this->name],
            ['play_date', '>=', $startDate->format('Y-m-d')],
            ['play_date', '<', $currentDate->format('Y-m-d')],
        ])->orWhere([
            ['away_team', $this->name],
            ['play_date', '>=', $startDate->format('Y-m-d')],
            ['play_date', '<', $currentDate->format('Y-m-d')],
        ])->first();

        if($match == null) {
           return false;
        }

        if($match->home_team == $this->name && $match->home_goals < $match->away_goals) {
            return true;
        } else if($match->away_team == $this->name && $match->home_goals > $match->away_goals) {
            return true;
        } else if($match->home_goals == $match->away_goals) {
            return false;
        } 

        return false;
    }
 
    /**
     * Teams that are eligible to reach the next round
     * use this function for predictions
     */
    public static function teamsEligibleForNextRound($roundNumber)
    {
        return TeamRoundNumber::where('round_number', $roundNumber - 1)->get()->map(function($teamRoundNumber){            
            return Team::find($teamRoundNumber->team_id);
        });

    } 

    /**
     * Teams that made it to the next round
     * use this to compare predictions to the actual outcomes of the tournament
     */
    public static function teamsInRound($roundNumber)
    {
        return TeamRoundNumber::where('round_number', $roundNumber)->get()->map(function($teamRoundNumber) {
            return Team::find($teamRoundNumber->team_id);
        });
    }

    public static function updateOrInsert($teams)
    {   
        $teams->each(function($team) {
            $team = $team->toArray();
            Team::updateOrCreate($team, ['team_id'=> $team['team_id'] ]);
        });
    }
}
