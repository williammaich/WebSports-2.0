<?php

use Illuminate\Database\Seeder;

class QuadrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quadras')->insert([
            'valorLocacao' => 100,
            'tipoQuadra_id' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
