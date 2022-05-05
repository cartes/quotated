<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'path' => \Faker\Provider\Image::image(
            storage_path() . '/app/public/products', 350, 400,
            $faker->randomElement(['food', 'fashion', 'transport']), false),
        'picture' => $faker->word,
        'imageable_type' => 'App\Product',
        'order' => $faker->numberBetween(0, 5),
    ];
});
