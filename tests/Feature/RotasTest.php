<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RotasTest extends TestCase
{


    public function test_acting_as_a_cliente()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user,'api');

        
        $this->json('GET', '/api/clientes/')
            ->assertStatus(200);


    }

    public function test_acting_as_a_endereco()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user,'api');


        $this->json('GET', '/api/enderecos/')
            ->assertStatus(200);


    }

    public function test_acting_as_a_pagamento()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user,'api');


        $this->json('GET', '/api/pagamentos/')
            ->assertStatus(200);


    }

    public function test_acting_as_a_quadra()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user,'api');


        $this->json('GET', '/api/quadras/')
            ->assertStatus(200);


    }

    public function test_acting_as_a_reservas()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user,'api');


        $this->json('GET', '/api/reservas/')
            ->assertStatus(200);


    }

    public function test_acting_as_a_tipoQuadras()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user,'api');


        $this->json('GET', '/api/tipoQuadras/')
            ->assertStatus(200);


    }
}







