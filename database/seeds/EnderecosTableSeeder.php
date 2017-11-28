<?php

use Illuminate\Database\Seeder;

class EnderecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('enderecos')->insert([
        //     'rua' => 'Olavo Bilac',
        //     'numero' => 718,
        //     'complemento' => 'Casa 7',
        //     'cidade' => 'Pelotas',
        //     'cep' => 96470000,
        //     'created_at' => date('Y-m-d h:i:s'),
        //     'updated_at' => date('Y-m-d h:i:s')
        // ]);

        factory(\App\Endereco::class, 30)->create();
        
    }
}
