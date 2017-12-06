<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
  public function index()
  {
    // Pq não assim?
    // DB::table não se precisa usar quando temos as models
    // podemos utilizar chamando direto a model como fiz abaixo
    // $users = DB::table('users')->count();

    $clientes = \App\Cliente::all()->count();
    $reservas = \App\Reserva::all()->count();

    // Pq não "->toJson()"
    // pq o returno do count é só um numero,
    // ele não consegue transformar um numero sozinho em json
    // return $clientes->toJson();


    // Então criamos um array e transformamos em json
    return json_encode(array(
      'clientes' => $clientes,
      'reservas' => $reservas
    ));
  }
}
