<?php

use Illuminate\Database\Seeder;

class ReservasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        // DB::table('reservas')->insert([
        //     'dataReservada' => '2017-10-20 10:00:00',
        //     'quadra_id' => 1,
        //     'pagamento_id' => 1,
        //     'cliente_id' => 1,
        //     'created_at' => date('Y-m-d h:i:s'),
        //     'updated_at' => date('Y-m-d h:i:s')
        // ]);
        factory(\App\Reserva::class, 30)->create();

=======
        DB::table('reservas')->insert([
            'dataReservada' => '2017-10-20 10:00:00',
            'quadra_id' => 1,
            'quantidade' => 1,
            'pagamento_id' => 1,
            'cliente_id' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
>>>>>>> 43b84c58126285abb73ba2bd5ef76cf6b0d78e93
    }
}
