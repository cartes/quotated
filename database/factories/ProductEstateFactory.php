<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductEstate;
use Faker\Generator as Faker;

$factory->define(ProductEstate::class, function (Faker $faker) {
    return [
        'product_id' => \App\Product::all()->random()->id,
        'type' => $faker->randomElement([
            'Casa', 'Departamento', 'Locales', 'Estacionamientos', 'Bodegas', 'Oficinas', 'Parcelas', 'Sitios', 'Terrenos', 'Otros'
        ]),
        'operation' => $faker->randomElement(['Arriendo', 'Venta', 'Arriendo Temporal']),
        'sub_type' => $faker->randomElement(['Usadas', 'Proyecto']),
    ];
});
