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
    // $users = DB::table('users')->count();
      //return $users->get()->toJson();
      //return Response::json($users);

    // podemos utilizar chamando direto a model como fiz abaixo
    $clientes = \App\Cliente::all()->count();
    $reservas = \App\Reserva::all()->count();

      // Pq não "->toJson()"
      // pq o returno do count é só um numero,
      // ele não consegue transformar um numero sozinho em json
      // return $clientes->toJson();

      /*
       * Busca todas as reservas, agrupadas pela data reserva
       * O Carbon está convertendo o que ele encontrar de dataReservada nos registros
       * para um formato de apenas Mês
       * então isso vai me retornar um array tipo:
       * "month": [
       *       "12" => [
       *             ["id" => 1, "dataReservada" => "2017-03-12 15:51:00]
       *             ["id" => 2, "dataReservada" => "2017-04-12 10:50:00] *
       *       ],
       *        "11" => [
       *               ["id" => 42, "dataReservada" => "2017-03-11 15:51:00]
       *               ["id" => 25, "dataReservada" => "2017-04-11 10:50:00] *
       *          ];
       * ]
       */
      $month = \App\Reserva::all(['dataReservada'])->groupBy(function($val) {
          return \Carbon\Carbon::parse($val->dataReservada)->format('m');
      });

      // Então criamos um array e transformamos em json
      return json_encode(array(
      'clientes' => $clientes,
      'reservas' => $reservas,
      'month' => $month
    ));
  }
}
