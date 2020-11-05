<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\salasController;
use App\Http\Controllers\usuariosController;

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

/* 
* Aqui para baixo fica as rotas do usuário, como login e cadastro
*/

// --------------------------------------------------------------------------
Route::get('/login', function () {
    return view('login');
});

Route::post('/entrando', [usuariosController::class, 'logarUsuario']);
// --------------------------------------------------------------------------

Route::get('/cadastro', function () {
    return view('cadastro');
});

Route::post('/cadastrar', [usuariosController::class, 'cadastrarUsuario']);
// --------------------------------------------------------------------------

/* 
* Aqui para baixo fica as rotas de sala
*/