<?php

use Faker\Generator as Faker;
use App\Match;
use App\Team;

$factory->define(Match::class, function (Faker $faker) {
    return [
        'play_date' => '13-07-2018',
        'start_time' => '12:00',
        'end_time' => '14:00',
        'home_team_id' => factory(Team::class)->create()->id,
        'away_team_id' => factory(Team::class)->create()->id,
        'goals_home' => 99,
        'goals_away' => 0,
    ];
});
