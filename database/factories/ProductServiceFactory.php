<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductService;
use Faker\Generator as Faker;

$factory->define(ProductService::class, function (Faker $faker) {
    return [
        'product_id' => \App\Product::all()->random()->id,
        'type' => $faker->randomElement(['Belleza', 'Porfesionales', 'Clases', 'Eventos', 'Trasalados', 'Otros']),
        'sub_type' => $faker->word,
    ];
});
