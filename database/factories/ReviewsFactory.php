<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reviews;
use Faker\Generator as Faker;

$factory->define(Reviews::class, function (Faker $faker) {
    return [
        'product_id' => \App\User::all()->random()->id,
        'rating' => $faker->randomFloat(2,1,5),
    ];
});
