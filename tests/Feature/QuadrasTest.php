<?php

namespace Tests\Feature;

use App\Quadra;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuadrasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_quadra_index()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $quadras = $this->json('GET', '/api/quadras/')
            ->assertJsonFragment(array(
                "id" => 1
            ))
            ->assertStatus(200);

    }


    public function test_quadra_create() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $quadras = $this->json('POST', '/api/quadras/', array(

            "valorLocacao" => 100,
            "tipoQuadra_id" => 1,
            "created_at" => date('Y-m-d h:i:s'),
            "updated_at" => date('Y-m-d h:i:s')


        ))->assertJsonFragment(array(
            "valorLocacao" => 100
        ))->assertStatus(200);
    }

    public function test_quadra_update() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');



        $quadras = $this->json('PUT', '/api/quadras/1', array(
            "valorLocacao" => 100


        ))->assertJsonFragment(array(
            "valorLocacao" => 100

        ))->assertStatus(200);
    }

    public function test_quadra_show() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $quadra = Quadra::find(1);


        $quadras = $this->json('GET', '/api/quadras/2')
            ->assertJsonFragment(array(
                "valorLocacao" => $quadra->valorLocacao
            ))->assertStatus(200);
    }
}
