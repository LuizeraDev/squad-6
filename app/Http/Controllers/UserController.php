<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// Permite o uso do banco de dados
use Illuminate\Support\Facades\DB;

// Permite verificar se usuário está logado.
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logoff()
    {
       session_start();
       $email = $_SESSION['usuario'];

        // Atualiza status do usuário logado para offline
        DB::table('users')
            ->where('email', $email)
            ->update(['status' => 'offline','unidade' => NULL, 'report' => NULL,
            'utilizando_sala' => NULL,'cd_fila_usuario' => NULL,'cd_sala_santos' => NULL,  'cd_sala_sao_paulo' => NULL]);

        Auth::logout();

        return redirect()->route('login');
    }
}