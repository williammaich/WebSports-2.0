<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuadrasTest extends TestCase
{


    use DatabaseTransactions;



    public function test_create_quadra()
    {



        \App\Quadra::create([

            'valorLocacao' => 100,
            'tipoQuadra_id' => 1
        ]);

        $this->assertDatabaseHas('Quadras',['valorLocacao' => '100' ]);
    }


    public function test_create_quadra_sem_valor()
    {



        \App\Quadra::create([

            'valorLocacao' => '0',
            'tipoQuadra_id' => 1
        ]);

        $this->assertDatabaseHas('Quadras',['valorLocacao' => '0' ]);
    }


    public function test_create_quadra_sem_tipo()
    {



        \App\Quadra::create([

            'valorLocacao' => '0',

            'tipoQuadra_id' => 1
        ]);

        $this->assertDatabaseMissing('Quadras',['valorLocacao' => '0' ]);
    }

    public function test_create_tipo_quadra()
    {
   \App\TipoQuadra::create([
       'descricao' => 'Quadra do tipo salão'
   ]);

   $this->assertDatabaseHas('tipo_quadras',['descricao' => 'Quadra do tipo salão']);

    }

    public function test_create_quadra_tipo_quadra()
    {

        $tipo = \App\TipoQuadra::create([
            'descricao' => 'Quadra do tipo salao'

        ]);

        $quadra = \App\Quadra::create([

            'valorLocacao' => '0',
            'tipoQuadra_id' => $tipo->id
        ]);



        $this->assertDatabaseHas('Quadras',['valorLocacao' => '0', 'tipoQuadra_id' => $tipo->id]);
        $this->assertDatabaseHas('tipo_quadras',['descricao' => 'Quadra do tipo salão']);
    }

}
?>