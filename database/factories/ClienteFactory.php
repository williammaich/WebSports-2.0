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

$factory->define(App\Cliente::class, function (Faker $faker) {
    static $password;
    $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
    $enderecos = App\Endereco::all()->pluck('id');
    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cpf' => $faker->cpf(false),
        'saldo' => $faker->numberBetween(0, 1000),
        'endereco_id' =>  $faker->randomElement($enderecos),
        'created_at' => date('Y-m-d h:i:s'),
        'updated_at' => date('Y-m-d h:i:s')
    ];
});
