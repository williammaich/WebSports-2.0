<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{


    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_cliente()
    {



    \App\Cliente::create([

        'nome' => 'Admin Cliente',
        'email' => 'adimin@admin.com',
        'cpf' => 14245554565,
        'saldo' => 80,
        'endereco_id' => 1
    ]);

    $this->assertDatabaseHas('Clientes',['nome' => 'admin Cliente' ]);
    }


    public function test_create_cliente_sem_nome()
    {



        \App\Cliente::create([

            'nome' => '',
            'email' => 'adimin@admin.com',
            'cpf' => 14245554565,
            'saldo' => 80,
            'endereco_id' => 1
        ]);

        $this->assertDatabaseHas('Clientes',['nome' => '' ]);
    }

    public function test_create_cliente_endereco()
    {

        $endereco = \App\Endereco::create([
            'rua' => 'rua Narciso Silva',
            'numero' => 2900,
            'complemento' => 'rua',
            'cidade' => 'Capao do Leão',
            'cep' => 96160000
        ]);

       $cliente = \App\Cliente::create([

            'nome' => 'cliente',
            'email' => 'adimin@admin.com',
            'cpf' => 14245554565,
            'saldo' => 80,
            'endereco_id' => $endereco->id
        ]);



        $this->assertDatabaseHas('Clientes',['nome' => 'cliente', 'endereco_id' => $endereco->id ]);
        $this->assertDatabaseHas('Enderecos',['rua' => 'rua Narciso Silva']);
    }



}
