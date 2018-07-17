<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Match extends Model
{
    protected $guarded = [];

    const PUBLISH_MATCH_AFTER_TIME = 70;

    public function home_team()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }


    public function away_team()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    
    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }

}
