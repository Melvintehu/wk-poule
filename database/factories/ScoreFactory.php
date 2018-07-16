<?php

use Faker\Generator as Faker;
use App\Score;

$factory->define(Score::class, function (Faker $faker) {
    return [
        'total' => $faker->numberBetween(10, 200),
    ];
});
