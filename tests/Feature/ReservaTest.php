<?php

namespace Tests\Feature;

<<<<<<< HEAD
use App\Reserva;
=======
>>>>>>> develop
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
<<<<<<< HEAD
    public function test_reserva_index()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $reservas = $this->json('GET', '/api/reservas/')
            ->assertJsonFragment(array(
                "id" => 1
            ))
            ->assertStatus(200);

    }


    public function test_reserva_create() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $reservas = $this->json('POST', '/api/reservas/', array(

            "dataReservada" => "2017-11-20 10:00:00",
            "quadra_id" => 1,
            "pagamento_id" => 1,
            "cliente_id" => 1,
            "created_at" => date('Y-m-d h:i:s'),
            "updated_at" => date('Y-m-d h:i:s')


        ))->assertJsonFragment(array(
            "dataReservada" => "2017-11-20 10:00:00"
        ))->assertStatus(200);
    }

    public function test_reserva_update() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');



        $reservas = $this->json('PUT', '/api/reservas/1', array(
            "dataReservada" => "2017-11-20 10:00:00"


        ))->assertJsonFragment(array(
            "dataReservada" => "2017-11-20 10:00:00"

        ))->assertStatus(200);
    }

    public function test_reserva_show() {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $reserva = Reserva::find(2);


        $reservas = $this->json('GET', '/api/reservas/2')
            ->assertJsonFragment(array(
                "dataReservada" => $reserva->dataReservada
            ))->assertStatus(200);
=======
    public function testExample()
    {
        $this->assertTrue(true);
>>>>>>> develop
    }
}
