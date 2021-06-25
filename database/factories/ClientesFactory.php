<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clientes;
use Faker\Generator as Faker;

$factory->define(Clientes::class, function (Faker $faker) {
    return [
        'nombreCliente' => $faker->unique()->name,
        'correoCliente' => $faker->unique()->safeEmail,
        'celularCliente' => $faker->phoneNumber,
        'cumpleanosCliente' => $faker->date,
        'direccionCliente' => $faker->address,
    ];
});
