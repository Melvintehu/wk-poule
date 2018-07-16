<?php 
namespace App\Queries;

use App\Match;
use Carbon\Carbon;

class MatchesPlayed
{
    
    const PUBLISH_MATCH_AFTER_TIME = 70;

    public static function get()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $match_publish_time = Carbon::now()->subMinutes(Static::PUBLISH_MATCH_AFTER_TIME)->format('H:i:s');
        
        return Match::has('statistic')->where([
            ['play_date', '>=', $current_date],
            ['end_time', '<=', $match_publish_time],
        ])->get();
    }

}
