<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\salasController;
use App\Http\Controllers\filasController;

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//------------------------------------------------------------------------------

// Unidades

Route::get('/unidade', function(){
	return view('salas/unidade');
});

Route::get('/unidade/santos', [salasController::class, 'salaSantos']);

Route::get('/unidade/saopaulo', [salasController::class, 'salasaoPaulo']);
//------------------------------------------------------------------------------

// Salas 

Route::get('/criarsala', function(){
	return view('salas/criarSala');
});

Route::post('/cadastrandosala', [salasController::class, 'cadastrarSala']);

Route::get('/salas',[salasController::class, 'exibirSalas'])->name('salas');

Route::get('/salas/sala/{nomeSala}/{id}', function ($nomeSala, $salaId) {
    return view('salas/filaSala', ['nomeSala' => $nomeSala, 'salaId' => $salaId]);
});

Route::get('/salas/sala/{nomeSala}/excluir/{id}', function ($nomeSala, $salaId) {
    return view('salas/excluirSala', ['nomeSala' => $nomeSala, 'salaId' => $salaId]);
})->where(['id' => '[0-9]+']);
// Esse where trata os parâmetros. 

Route::get('/salas/sala/{nomeSala}/excluir/{id}/do', [salasController::class, 'excluirSala']);
//------------------------------------------------------------------------------

// FILAS 

Route::get('/salas/sala/{nomeSala}/{id}', [filasController::class, 'inserirusuarioFila'])->name('inserirFila');

Route::get('/salas/sala/{nomeSala}/{id}/desistente', [filasController::class, 'desistirusuarioFila'])->name('desistir');

Route::get('/salas/sala/{nomeSala}/{id}/voujogar', [filasController::class, 'vouJogarFila'])->name('voujogar');