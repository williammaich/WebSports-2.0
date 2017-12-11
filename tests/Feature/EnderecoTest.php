<?php

namespace Tests\Feature;

use App\Reserva;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnderecoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_endereco_index()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $enderecos = $this->json('GET', '/api/enderecos/')
            ->assertJsonFragment(array(
                "id" => 1
            ))
            ->assertStatus(200);

    }


    public function test_endereco_create() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $enderecos = $this->json('POST', '/api/enderecos/', array(

            "rua" => "Olavo Bilac",
                 "numero" => 718,
                 "complemento" => "Casa 7",
                 "cidade" => "Pelotas",
                 "cep" => 96470000,
                 "created_at" => date('Y-m-d h:i:s'),
              "updated_at" => date('Y-m-d h:i:s')


        ))->assertJsonFragment(array(
            "rua" => "Olavo Bilac",
            "numero" =>718
        ))->assertStatus(200);
    }

    public function test_endereco_update() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');



        $enderecos = $this->json('PUT', '/api/enderecos/1', array(
            "rua" => "Olavo Bilac"


        ))->assertJsonFragment(array(
            "rua" => "Olavo Bilac"

        ))->assertStatus(200);
    }

    public function test_endereco_show() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $endereco = Reserva::find(2);


        $enderecos = $this->json('GET', '/api/enderecos/2')
            ->assertJsonFragment(array(
                "rua" => $endereco->rua
            ))->assertStatus(200);
    }
}
