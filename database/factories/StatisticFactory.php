<?php

use Faker\Generator as Faker;
use App\Statistic;

$factory->define(Statistic::class, function (Faker $faker) {
    return [
        'goals_home' => 0,
        'goals_away' => 0,
        'yellow_cards_home' => 0,
        'yellow_cards_away' => 0,
        'red_cards_home' => 0,
        'red_cards_away' => 0,
    ];
});
