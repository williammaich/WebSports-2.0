<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Endereco::class, function (Faker $faker) {
    static $password;
    // $faker->addProvider(new \Faker\Provider\en_US\Address);
    return [
        'rua' => $faker->streetName,
        'numero' => $faker->buildingNumber,
        'complemento' => $faker->secondaryAddress,
        'cidade' => $faker->city,
        'cep' => $faker->numberBetween(90000000, 99999999),
        'created_at' => date('Y-m-d h:i:s'),
        'updated_at' => date('Y-m-d h:i:s')
    ];
});
