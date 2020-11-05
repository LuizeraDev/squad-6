<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// --------------------------------------------------------------------------
Route::get('/login', function () {
    return view('login');
});

Route::get('/logar', 'usuariosController@login');
// --------------------------------------------------------------------------

Route::get('/cadastro', function () {
    return view('cadastro');
});

Route::get('/cadastrar-se', 'usuariosController@cadastro');
// --------------------------------------------------------------------------

Route::get('/santos', 'salasController@salasSantos');

Route::get('/sao-paulo', 'salasController@salasSaoPaulo');
// --------------------------------------------------------------------------

Route::get('/cadastrar-salas', function () {
    return view('cadastrar-salas');
});

Route::get('/fila', 'salasController@mostrarFila');
