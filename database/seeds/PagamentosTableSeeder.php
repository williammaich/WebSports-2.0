<?php

use Illuminate\Database\Seeder;

class PagamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pagamentos')->insert([
            'id' => 1,
            'valor' => 100,
            'dataPagamento' => '2017-10-11 11:42:04',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
        DB::table('pagamentos')->insert([
            'id' => 2,
            'valor' => 100,
            'dataPagamento' => '2017-10-11 11:42:04',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
