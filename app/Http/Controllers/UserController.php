<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all()->toJson();
        return $user;

        //$user = User::all();
        //return response()->json($user);
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
            'name' => 'required|max:191',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $dadosFormulario = $request->all();

        User::create($dadosFormulario);


        return response(200)->json([
            "status" => "Cadastrado com sucesso"
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id)->toJson();
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

        // obtém os dados do form
        $dadosFormulario = $request->all();

        // posiciona no registo a ser alterado
        $reg = User::find($id);

        // realiza a alteração
        $reg->update($dadosFormulario);

        return response(200)->json([
            "status" => "Alterado com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // posiciona no registo a ser deletado
        $reg = User::find($id);

        // Deleta
        $reg->delete();

        return response(200)->json([
            "status" => "Removido com sucesso"
        ]);
    }
}
