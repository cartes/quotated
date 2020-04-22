<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductCar;
use Faker\Generator as Faker;

$factory->define(ProductCar::class, function (Faker $faker) {
    return [
        'product_id' => \App\Product::all()->random()->id,
        'brand' => $faker->word,
        'model' => $faker->word,
    ];
});
