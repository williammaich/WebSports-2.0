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

$factory->define(App\Reserva::class, function (Faker $faker) {
    static $password;
    $faker->addProvider(new \Faker\Provider\DateTime($faker));
    return [
      'dataReservada' => $faker->dateTimeThisMonth('now', date_default_timezone_get()),
      'quadra_id' => 1,
      'pagamento_id' => 1,
      'quantidade' => $faker->numberBetween(1,3),
      'cliente_id' => $faker->numberBetween(1,30),
      'created_at' => date('Y-m-d h:i:s'),
      'updated_at' => date('Y-m-d h:i:s')
    ];
});
