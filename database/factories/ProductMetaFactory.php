<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductMeta;
use Faker\Generator as Faker;

$factory->define(ProductMeta::class, function (Faker $faker) {
    return [
        'product_id' => \App\Product::all()->random()->id,
        'factory' => $faker->company,
        'brand' => $faker->word,
        'model' => $faker->creditCardNumber,
        'line' => $faker->word,
    ];
});
