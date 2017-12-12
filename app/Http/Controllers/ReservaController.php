<?php

namespace App\Http\Controllers;

use App\Reserva;
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
            'cliente_id' => 'required',
        ]);

        $reserva = $request->all();

        Reserva::create($reserva);

        // $reg = Reserva::with('Cliente', 'Pagamento', 'Quadra')->get();

        // $reg->create($reserva);


        return $this->index();
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
        $request->validate([
            'quantidade' => 'required',
            'dataReservada' => 'required',
            'cliente_id' => 'required',
        ]);

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

        return $this->index();
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

        return $this->index();
    }
}
