<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Reserva_index()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $reservas = $this->json('GET', '/api/reservas/')
            ->assertJsonFragment(array(
                "id" => 1
            ))
            ->assertStatus(200);

    }


    public function test_cliente_create() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $reservas = $this->json('POST', '/api/reservas/', array(

            "dataReservada" => "2017-10-20 10:00:00",
            //     'quadra_id' => 1",
            //     'pagamento_id' => 1,
            //     'cliente_id' => 1,
            //     'created_at' => date('Y-m-d h:i:s'),
            //     'updated_at' => date('Y-m-d h:i:s')

            "nome" => "William Maich",
            "email" => "williammaich@gmail.com",
            "cpf" => "258.151.140.01",
            "saldo" => 200,
            "endereco" => array(
                "rua" => "Rua Lobo da Costa",
                "numero" => 409,
                "complemento" => "APT 401",
                "cidade" => "Pelotas",
                "cep" => "96010470"
            )
        ))->assertJsonFragment(array(
            "nome" => "William Maich"
        ))->assertStatus(200);
    }


}
