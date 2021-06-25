<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Usuarios;
use Faker\Generator as Faker;

$factory->define(Usuarios::class, function (Faker $faker) {
    return [
        'docUsuario' => $faker->randomNumber,
        'nombreCompleto' => $faker->unique()->name,
        'user' => $faker->unique()->userName,
        'password' => $faker->password,
        'email' => $faker->unique()->safeEmail,
        'celular' => $faker->phoneNumber,
        'estudiosUsuario' => $faker->word,
        'especialUsuario' => $faker->word,
        'idRol' => $faker->randomElement([1,2]),
    ];
});
