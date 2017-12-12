<?php

namespace Tests\Feature;

use App\TipoQuadra;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipoQuadrasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_tipoQuadra_index()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $tquadras = $this->json('GET', '/api/tipoQuadras/')
            ->assertJsonFragment(array(
                "id" => 1
            ))
            ->assertStatus(200);

    }


    public function test_tipoQuadras_create() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $tquadras = $this->json('POST', '/api/tipoQuadras/', array(

            "descricao" => "Quadra 1",
            "created_at" => date('Y-m-d h:i:s'),
            "updated_at" => date('Y-m-d h:i:s')


        ))->assertJsonFragment(array(
            "descricao" => "Quadra 1"
        ))->assertStatus(200);
    }

    public function test_tipoQuadra_update() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');



        $tquadras = $this->json('PUT', '/api/tipoQuadras/1', array(
            "descricao" => "Quadra 1"


        ))->assertJsonFragment(array(
            "descricao" => "Quadra 1"

        ))->assertStatus(200);
    }

    public function test_tipoQuadra_show() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $tquadra = TipoQuadra::find(2);


        $tquadras = $this->json('GET', '/api/tipoQuadras/2')
            ->assertJsonFragment(array(
                "descricao" => $tquadra->descricao
            ))->assertStatus(200);
    }
}
