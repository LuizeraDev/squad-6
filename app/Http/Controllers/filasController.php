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
                    ->update(['cd_fila_usuario' => $quantidade]);
        }

        return filasController::pegadadosusuarioSala($nomeSala, $id);
    }


    public function pegadadosusuarioSala($nomeSala, $id)
    {
        $email = $_SESSION['usuario'];

        $usuario = DB::table('users')
                    ->select('name', 'cd_fila_usuario')
                    ->where('email', $email)
                    ->get();

        return filasController::exibirFila($nomeSala, $id, $usuario);
    }
    

    public function exibirFila($nomeSala, $id, $usuario)
    {
        $filaSantos = DB::table('users')
                         ->select('name', 'cd_fila_usuario',  'profile_photo_path')
                         ->where('cd_sala_santos', $id)
                         ->get();

        $filaSaoPaulo = DB::table('users')
                         ->select('name', 'cd_fila_usuario',  'profile_photo_path')
                         ->where('cd_sala_sao_paulo', $id)
                         ->get();

        return view('salas/filaSala', ['filaSantos' => $filaSantos, 
        'filaSaoPaulo' => $filaSaoPaulo, 
        'nmSala' => $nomeSala,
        'dadosUsuario'=> $usuario]);
    }

    public function desistirusuarioFila()
    {
        session_start();
        $email = $_SESSION['usuario'];

        // Retira o usuário da fila e volta o código da fila dele para nulo
        if ($_SESSION['santos']) {
            DB::table('users')
                    ->where('email', $email)
                    ->update(['cd_sala_santos'=> null, 'cd_fila_usuario' => null]);
        } else { 
            DB::table('users')
                    ->where('email', $email)
                    ->update(['cd_sala_sao_paulo'=> null, 'cd_fila_usuario' => null]);
        }

        return redirect()->route('salas');
    }

}
