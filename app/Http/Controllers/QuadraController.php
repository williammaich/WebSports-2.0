<?php

namespace App\Http\Controllers;

use App\Quadra;
use Illuminate\Http\Request;

class QuadraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quadra = Quadra::with('TipoQuadra')->get()->toJson();
        return $quadra;
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
        $quadra = Quadra::with('TipoQuadra')->get()->toJson();

        Quadra::create($quadra);

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
        //
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
        $quadra = $request->all();

        $reg = Quadra::with('TipoQuadra')->find($id);

        if (isset($quadra['tipoQuadra'])) {
            $reg->tipoQuadra->update($quadra['tipoQuadra']);
        }

        $reg->update($quadra);

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
        $reg = Quadra::find($id);

        $reg->delete();

        return $this->index();
    }
}
