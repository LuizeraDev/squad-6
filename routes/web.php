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

// --------------------------------------------------------------------------
Route::get('/login', function () {
    return view('login');
});

Route::get('/logar', [salasController::class, 'logarUsuario']);
// --------------------------------------------------------------------------

Route::get('/cadastro', function () {
    return view('cadastro');
});

Route::get('/cadastrar', [usuariosController::class, 'cadastrarUsuario']);
// --------------------------------------------------------------------------
