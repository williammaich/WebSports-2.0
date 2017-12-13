<?php

namespace App\Http\Controllers;

use App\Reserva;
use DateTime;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reserva = Reserva::with('Cliente', 'Pagamento', 'Quadra')->get()->toJson();

        return $reserva;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantidade' => 'required',
            'dataReservada' => 'required',
        ]);

        $reserva = $request->all();
        $cliente = \App\Cliente::where('nome', '=', $reserva['cliente']['nome'])->first();
        $pagamentoAssert = false;
        if($reserva['pagamento']) {
            $pagamento = \App\Pagamento::create([
                "valor" => 100,
                "dataPagamento" => new DateTime('now')
            ]);
            $pagamentoAssert = true;
        }
        Reserva::create([
            "dataReservada" => $reserva['dataReservada'],
            "cliente_id" => $cliente->id,
            "quadra_id" => $reserva['quadra'],
            "quantidade" => $reserva['quantidade'],
            "pagamento_id" => $pagamentoAssert ? $pagamento->id : null
        ]);

        // $reg = Reserva::with('Cliente', 'Pagamento', 'Quadra')->get();

        // $reg->create($reserva);


        return response(200)->json([
            "status" => "Cadastrado com sucesso"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Reserva::with('Cliente', 'Pagamento', 'Quadra')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $reserva = $request->all();

        $reg = Reserva::with('Cliente', 'Pagamento', 'Quadra')->find($id);

        if (isset($reserva['cliente'])) {
            $reg->cliente->update($reserva['cliente']);
        }
        if (isset($reserva['quadra'])) {
            $reg->quadra->update($reserva['quadra']);
        }
        if (isset($reserva['pagamento'])) {
            $reg->pagamento->update($reserva['pagamento']);
        }

        $reg->update($reserva);

        return response(200)->json([
            "status" => "Alterado com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = Reserva::find($id);

        $reg->delete();

        return response(200)->json([
            "status" => "Removido com sucesso"
        ]);
    }
}
