<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\salasController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//------------------------------------------------------------------------------

// Salas Santos

Route::get('/criarsala', function(){
	return view('salas/criarSala');
});

Route::post('/cadastrandosala', [salasController::class, 'cadastrarSala']);

Route::get('/salassantos',[salasController::class, 'exibirSalas']);

Route::get('/salassantos/sala/{nomeSala}/{id}', function ($nomeSala, $salaId) {
    return 'Nome da sala: '.$nomeSala. " Id da sala: ". $salaId;
});

Route::get('/salassantos/sala/{nomeSala}/excluir/{id}', function ($nomeSala, $salaId) {
    return 'Nome da sala a ser excluida: '.$nomeSala. " Id da sala: ". $salaId;
});
//------------------------------------------------------------------------------
