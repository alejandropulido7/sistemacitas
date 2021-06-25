<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CategoriaProd;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(CategoriaProd::class, function (Faker $faker) {
    return [
        // 'nombreCatProducto' => $faker->text($maxNbChars=10),
        // 'notaCatProducto' => $faker->sentences($nb = 3, $asText = false),
        'nombreCatProducto' => $faker->name,
        'notaCatProducto' => $faker->name,
    ];
});
