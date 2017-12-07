<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->count();

        //return $users->get()->toJson();
        return Response::json($users);
    }
}
