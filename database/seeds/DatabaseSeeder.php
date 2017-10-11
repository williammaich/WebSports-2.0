<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(EnderecosTableSeeder::class);
        //$this->call(PagamentosTableSeeder::class);
        $this->call(QuadrasTableSeeder::class);
        //$this->call(ReservasTableSeeder::class);
        $this->call(TipoQuadrasTableSeeder::class);
        //$this->call(UsuariosTableSeeder::class);
    }
}
