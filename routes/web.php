<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\salasController;

use App\Http\Controllers\filasController;

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;

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
	if (!Auth::user())
            return view('auth/login');

	return view('salas/unidade');
});

Route::get('/unidade/santos', [salasController::class, 'salaSantos']);

Route::get('/unidade/saopaulo', [salasController::class, 'salasaoPaulo']);
//------------------------------------------------------------------------------

// Salas 

Route::get('/criarsala', function(){
	if (!Auth::user())
            return view('auth/login');

	return view('salas/criarSala');
})->name('criarsala');

Route::post('/cadastrandosala', [salasController::class, 'cadastrarSala']);

Route::get('/salas', [salasController::class, 'exibirSalas'])->name('salas');

// Rota necessária para fazer assincronismo das salas com AJAX
Route::get('/salas-conteudo', [salasController::class, 'salasAssincronas'])->name('salasConteudo');

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

Route::get('/fila-conteudo', [filasController::class, 'filaAssincrona'])->name('filaConteudo');

Route::get('/salas/sala/{nomeSala}/{id}/desistente', [filasController::class, 'desistirusuarioFila'])->name('desistir');

Route::get('/salas/sala/{nomeSala}/{id}/voujogar', [filasController::class, 'vouJogarFila'])->name('voujogar');
//------------------------------------------------------------------------------

Route::get('/reportar/{url}/{id}', [filasController::class, 'reportar']);

/*
* LOG OFF usuário
*/

Route::get('/sair', [UserController::class, 'logoff'])->name('sair');