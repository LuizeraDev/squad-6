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

        $verifica_usuario = DB::table('tb_usuario')
                ->where('nm_usuario', $usuario)
                ->where('cd_senha', $senha)
                ->get();

        echo $verifica_usuario;
        die();
        if ($verifica_usuario != null) {
            return view('unidade');
        } else {
            return view('cadastro', ['resposta' => "Este nome de usuário já está sendo utilizado."]);
        }
    }

    function cadastrarUsuario(Request $request)
    {   
        $usuario = $request->input('usuario');
        $senha = $request->input('senha');

        DB::table('tb_usuario')->insert(
            ['nm_usuario' => $usuario, 'cd_senha' => $senha, 'nm_primeiro_nome' => "NULL"]
        );

        return view('unidade');
    }

    function excluirUsuario()
    {

    }

    function alterarUsuario()
    {

    }
}
