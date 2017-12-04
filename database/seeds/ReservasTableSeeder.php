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
=======

>>>>>>> 347f39751c386dabec17df3fbae138fef7f187d5
        // DB::table('reservas')->insert([
        //     'dataReservada' => '2017-10-20 10:00:00',
        //     'quadra_id' => 1,
        //     'pagamento_id' => 1,
        //     'cliente_id' => 1,
        //     'created_at' => date('Y-m-d h:i:s'),
        //     'updated_at' => date('Y-m-d h:i:s')
        // ]);
        factory(\App\Reserva::class, 30)->create();
<<<<<<< HEAD

=======
>>>>>>> 347f39751c386dabec17df3fbae138fef7f187d5
    }
}
