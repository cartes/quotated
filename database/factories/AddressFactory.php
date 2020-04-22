<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'user_id' => \App\User::all()->random()->id,
        'address' => $faker->address,
        'state' => $faker->state,
        'commune' => $faker->city,
        'data' => $faker->paragraph,
    ];
});
