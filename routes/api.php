<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'auth:api']], function () {
    Route::get('/user', 'HomeController@index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController');

    Route::resource('reservas', 'ReservaController');

    Route::resource('tipoQuadras', 'TipoQuadraController');

    Route::resource('quadras', 'QuadraController');

    Route::resource('pagamentos', 'PagamentoController');

    Route::resource('enderecos', 'EnderecoController');

    Route::resource('clientes', 'ClienteController');

    Route::get('/relatorios', 'RelatorioController@index');
});

  

