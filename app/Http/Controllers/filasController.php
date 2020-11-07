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

class filasController extends Controller
{
    
    public function inserirusuarioFila($nomeSala, $id)
    {
        session_start();

        $email = $_SESSION['usuario'];

        if ($_SESSION['santos']) {
            DB::table('users')
                ->where('email', $email)
                ->update(['cd_sala_santos' => $id]);
        } else {
            DB::table('users')
            ->where('email', $email)
            ->update(['cd_sala_sao_paulo' => $id]);
        }

        return filasController::atualizarFila($nomeSala, $id);
    }

    public function atualizarFila($nomeSala, $id)
    {
        $email = $_SESSION['usuario'];

        if ($_SESSION['santos']) {
            $atualizarUsuario = DB::table('Users')
                                    ->select('cd_fila_usuario')
                                    ->where('cd_sala_santos', '=', $id)
                                    ->pluck('cd_fila_usuario');
        } else {
            $atualizarUsuario = DB::table('Users')
                                    ->select('cd_fila_usuario')
                                    ->where('cd_sala_sao_paulo', '=', $id)
                                    ->pluck('cd_fila_usuario');
        }

        $quantidade = count($atualizarUsuario);

        if ($atualizarUsuario != null) {
            // Faz atualização do campo cd_fila_usuario, para dizer sua posição na fila
            DB::table('users')
                    ->where('email', $email)
                    ->update(['cd_fila_usuario' => $quantidade + 1]);
        } else {
            // Coloca usuário como primeiro da fila
            DB::table('users')
                    ->where('email', $email)
                    ->update(['cd_fila_usuario' => 1]);
        }

        return filasController::exibirFila($nomeSala, $id);
    }

    /*
    public function pegadadosusuarioSala()
    {
        $usuario = DB::table('users')
                    ->select('name', 'cd_fila_usuario')
                    ->where('email', $email)
                    ->get();

        return view('salas/filaSala', ['dadosUsuario' => $usuario]);
    }
    */

    public function exibirFila($nomeSala, $id)
    {
        $filaSantos = DB::table('users')
                         ->select('name', 'cd_fila_usuario',  'profile_photo_path')
                         ->where('cd_sala_santos', $id)
                         ->get();

        $filaSaoPaulo = DB::table('users')
                         ->select('name', 'cd_fila_usuario',  'profile_photo_path')
                         ->where('cd_sala_sao_paulo', $id)
                         ->get();

        return view('salas/filaSala', ['filaSantos' => $filaSantos, 'filaSaoPaulo' => $filaSaoPaulo, 'nmSala' => $nomeSala]);
    }

    public function desistirFila()
    {

    }

}
