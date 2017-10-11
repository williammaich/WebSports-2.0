<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nome' => 'Roger Rezende',
            'senha' => '123',
            'email' => 'roger@gmail.com',
            'cpf' => '00000000000',
            'endereco_id' => 7,
            'saldo' => 0,
            'tipo' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
