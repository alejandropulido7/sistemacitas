<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Actividades;
use Faker\Generator as Faker;

$factory->define(Actividades::class, function (Faker $faker) {
    return [
        'nombreActividad' => $faker->randomElement(['Maquillaje','Pedicure', 'Manicure', 'Pestañas', 'Peinado']),
        'precioActividad' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000),
        'horaRequerida' => $faker->numberBetween($min = 0, $max = 15),
        'minRequerido' => $faker->numberBetween($min = 0, $max = 59),
    ];
});
