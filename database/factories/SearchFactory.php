<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Search;
use Faker\Generator as Faker;

$factory->define(Search::class, function (Faker $faker) {
    return [
        'search' => $faker->word,
        'user_id' => \App\User::all()->random()->id,
    ];
});
