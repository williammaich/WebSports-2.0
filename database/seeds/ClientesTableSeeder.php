<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('clientes')->insert([
        //     'nome' => 'Roger Rezende',
        //     'email' => 'jr@gmail.com',
        //     'cpf' => '01929384855',
        //     'saldo' => 200,
        //     'endereco_id' => 1,
        //     'created_at' => date('Y-m-d h:i:s'),
        //     'updated_at' => date('Y-m-d h:i:s')
        // ]);

        factory(\App\Cliente::class,60)->create();


    }
}
