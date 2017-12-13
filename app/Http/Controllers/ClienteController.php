<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::with('Endereco')->get()->toJson();

        return $cliente;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:150',
            'email' => 'required|max:120',
            'cpf' => 'required|max:11',
        ]);

        // $cliente = Cliente::with('Endereco')->get();

        $cliente = $request->all();
        $endereco = Endereco::create($cliente['endereco']);

        Cliente::create([
            "nome" => $cliente['nome'],
            "email" => $cliente['email'],
            "cpf" => $cliente['cpf'],
            "saldo" => $cliente['saldo'],
            "endereco_id" => $endereco->id,
        ]);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cliente::with('Endereco')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $cliente = $request->all();

        $reg = Cliente::with('endereco')->where('id', '=', $id)->first();


        if(isset($cliente['endereco'])){
             $reg->endereco->update($cliente['endereco']);
        }

        $reg->update($cliente);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = Cliente::find($id);

        $reg->delete();

        return $this->index();
    }
}
