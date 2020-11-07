<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// Permite pegar valores de inputs 
use Illuminate\Http\Request;

// Permite o uso do banco de dados
use Illuminate\Support\Facades\DB;

// Permite upload de arquivos 
use Illuminate\Http\UploadedFile;

// Permite redirecionar páginas
use Illuminate\Routing\Redirector;

class salasController extends Controller
{
    public function selecionarSala()
    {

    }

    public function cadastrarSala(Request $request)
    {
    	$nome = $request->input('nomeSala');
    	$img = $request->file('ImagemSala')->store('img_sala');

    	DB::table('tb_sala_santos')->insert(
            [ 'nm_sala' => $nome ,'img_sala' => $img]
        );

        salasController::exibirSalas();
    }

    public function excluirSala()
    {

    }

    public function exibirSalas()
    {
        $dados = DB::table('tb_sala_santos')
                        ->select('cd_sala_santos', 'nm_sala',  'img_sala')
                        ->get();
          
        return view('salas/salassantos', ['dados' => $dados]);
    }
}
