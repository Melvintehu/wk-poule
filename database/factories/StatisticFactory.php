<?php

use Faker\Generator as Faker;
use App\Statistic;
use App\Match;

$factory->define(Statistic::class, function (Faker $faker) {
    return [
        'goals_home' => 1,
        'goals_away' => 2,
        'yellow_cards_home' => 1,
        'yellow_cards_away' => 2,
        'red_cards_home' => 1,
        'red_cards_away' => 2,
    ];
});
