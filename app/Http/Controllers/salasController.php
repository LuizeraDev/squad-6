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

// Permite deletar imagens do storage
use Illuminate\Support\Facades\Storage;

class salasController extends Controller
{
    public function cadastrarSala(Request $request)
    {
    	$nome = $request->input('nomeSala');
    	$img = $request->file('ImagemSala')->store('img_sala');

    	DB::table('tb_sala_santos')->insert(
            [ 'nm_sala' => $nome ,'img_sala' => $img]
        );

        return redirect()->route('salassantos');

        salasController::exibirSalas();
    }

    public function excluirSala($nomeSala, $id)
    {
        $img = DB::table('tb_sala_santos')
                        ->select('img_sala')
                        ->where('cd_sala_santos', '=', $id)
                        ->pluck('img_sala');
        
        Storage::delete($img[0]);

        DB::table('tb_sala_santos')
                 ->where('cd_sala_santos', '=', $id)
                 ->delete();

        return redirect()->route('salassantos');
    }

    public function exibirSalas()
    {
        $dados = DB::table('tb_sala_santos')
                        ->select('cd_sala_santos', 'nm_sala',  'img_sala')
                        ->get();
          
        return view('salas/salassantos', ['dados' => $dados]);
    }
}
