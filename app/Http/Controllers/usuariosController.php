<?php

namespace App\Http\Controllers;

// Permite pegar valores de inputs 
use Illuminate\Http\Request;

// Permite o uso do banco de dados
use Illuminate\Support\Facades\DB;

// Permite upload de arquivos 
use Illuminate\Http\UploadedFile;

class usuariosController extends Controller
{
    /*
    * Aqui vamos definir os métodos que o usuário vai ter
    */

    function logarUsuario(Request $request)
    {
        $usuario = $request->input('usuario');
        $senha = $request->input('senha');
    }

    function cadastrarUsuario(Request $request)
    {   
        $usuario = $request->input('usuario');
        $senha = $request->input('senha');

        $quantidade = DB::table('tb_usuario')->where('nm_usuario')->value($usuario)->count();
        echo $quantidade;

        if ($quantidade == null) {
            return view('cadastro', ['resposta' => "Este nome de usuário já está sendo utilizado."]);
        } else {
            DB::table('tb_usuario')->insert(
                ['nm_usuario' => $usuario, 'cd_senha' => $senha]
            );
            return view('unidade');
        }
    }

    function excluirUsuario()
    {

    }

    function alterarUsuario()
    {

    }
}
