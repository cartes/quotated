<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'seller_id' => \App\Seller::all()->random()->id,
        'category_id' => \App\Category::all()->random()->id,
        'title' => $name,
        'slug' => \Illuminate\Support\Str::slug($name, '-') . '-' . $faker->unique()->randomNumber(),
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween('1000', '1300000'),
        'condition' => $faker->numberBetween('1', '2'),
    ];
});
