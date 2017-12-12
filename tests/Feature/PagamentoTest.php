<?php

namespace Tests\Feature;

use App\Pagameto;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagamentoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_pagamento_index()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $pagamentos = $this->json('GET', '/api/pagamentos/')
            ->assertJsonFragment(array(
                "id" => 1
            ))
            ->assertStatus(200);

    }


    public function test_pagamento_create() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $pagamentos = $this->json('POST', '/api/pagamentos/', array(

            "valor" => 200,
            "dataPagamento" => "2017-11-11 11:52:04",
            "created_at" => date('Y-m-d h:i:s'),
            "updated_at" => date('Y-m-d h:i:s')


        ))->assertJsonFragment(array(
            "valor" => 200,
            "dataPagamento" => "2017-11-11 11:52:04"
        ))->assertStatus(200);
    }

    public function test_pagamento_update() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');



        $pagamentos = $this->json('PUT', '/api/pagamentos/1', array(
            "valor" => 200


        ))->assertJsonFragment(array(
            "valor" => 200

        ))->assertStatus(200);
    }

    public function test_pagamento_show() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $pagamento = Pagameto::find(2);


        $pagamentos = $this->json('GET', '/api/pagamentos/2')
            ->assertJsonFragment(array(
                "valor" => $pagamento->valor
            ))->assertStatus(200);
    }
}
