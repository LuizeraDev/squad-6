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

// Permite validar imagens e outras coisas
use Illuminate\Validation\Rule;

// Permite verificar se usuário está logado.
use Illuminate\Support\Facades\Auth;


class salasController extends Controller
{
    public function salaSantos()
    {
        if (Auth::user() == null)
            return view('auth/login');

        if (isset($_SESSION)) {
            session_destroy();
        } else {
            session_start();
            $_SESSION['santos'] = true;
            $_SESSION['saopaulo'] = false;
        }

        return redirect()->route('salas');
    }

    public function salasaoPaulo()
    {
        if (Auth::user() == null)
            return view('auth/login');

        if (isset($_SESSION)) {
            session_destroy();
        } else {
            session_start();
            $_SESSION['santos'] = false;
            $_SESSION['saopaulo'] = true;
        }

        return redirect()->route('salas');
    }

    public function cadastrarSala(Request $request)
    {
        session_start();

        if (Auth::user() == null)
            return view('auth/login');

        $nome = $request->input('nomeSala');

        if (!$nome) {
            $erroNomeVazio = "Você não botou nenhum nome para a sala";
            return view('salas/criarSala', ['nome_vazio' => $erroNomeVazio]);
        }
        
        if ($request->file('ImagemSala')) 
            $img = $request->file('ImagemSala')->store('img_sala');
        else 
            $erroFoto = "Você não anexou nenhuma foto para a sala...";

        if ($_SESSION['santos']) {
            // Pega o nome da sala se existir uma sala com o mesmo nome
            $nomesalaSantos = DB::table('tb_sala_santos')
                                ->select('nm_sala')
                                ->where('nm_sala', '=',$nome)
                                ->pluck('nm_sala');

            // Validações
            if (isset($nomesalaSantos[0]) && !$request->file('ImagemSala')) {
                $erro = "Já existe uma sala com este nome em Santos...";
                $erroFoto = "Você não anexou nenhuma foto para a sala...";
                return view('salas/criarSala', ['MsgErro' => $erro, 'MsgErroFoto' => $erroFoto]);

            } else if (isset($nomesalaSantos[0])) {
                $erro = "Já existe uma sala com este nome em Santos...";
                return view('salas/criarSala', ['MsgErro' => $erro]);


            } else if (!$request->file('ImagemSala')) {
                $erroFoto = "Você não anexou nenhuma foto para a sala...";
                return view('salas/criarSala', ['MsgErroFoto' => $erroFoto]);
            
            } else {
                DB::table('tb_sala_santos')->insert(
                    [ 'nm_sala' => $nome ,'img_sala' => $img]);
                
                return redirect()->route('salas');
            }

        } else {
            // Pega o nome da sala se existir uma sala com o mesmo nome
            $nomesalaSaoPaulo = DB::table('tb_sala_sao_paulo')
                                ->select('nm_sala')
                                ->where('nm_sala', '=',$nome)
                                ->pluck('nm_sala');

            // Se a variável com o nome da sala já existe
            if (isset($nomesalaSaoPaulo[0]) && !$request->file('ImagemSala')) {
                $erro = "Já existe uma sala com este nome em São Paulo...";
                $erroFoto = "Você não anexou nenhuma foto para a sala...";
                return view('salas/criarSala', ['MsgErro' => $erro, 'MsgErroFoto' => $erroFoto]);

            } else if (isset($nomesalaSaoPaulo[0])) { 
                $erro = "Já existe uma sala com este nome em São Paulo...";
                return view('salas/criarSala', ['MsgErro' => $erro]);

            } else if (!$request->file('ImagemSala')) {
                $erroFoto = "Você não anexou nenhuma foto para a sala...";
                return view('salas/criarSala', ['MsgErroFoto' => $erroFoto]);

            } else { 
                DB::table('tb_sala_sao_paulo')->insert(
                    [ 'nm_sala' => $nome ,'img_sala' => $img]);
                
                return redirect()->route('salas');
            }
            
        }

    }

    public function excluirSala($nomeSala, $id)
    {
        session_start();

        if (Auth::user() == null)
            return view('auth/login');

        if ($_SESSION['santos']) {
            $img = DB::table('tb_sala_santos')
                             ->select('img_sala')
                             ->where('cd_sala_santos', '=', $id)
                             ->pluck('img_sala');
        
            // Deleta a imagem do Storage
            Storage::delete($img[0]);

            DB::table('tb_sala_santos')
                      ->where('cd_sala_santos', '=', $id)
                      ->delete();
        } else {
            $img = DB::table('tb_sala_sao_paulo')
                        ->select('img_sala')
                        ->where('cd_sala_sao_paulo', '=', $id)
                        ->pluck('img_sala');

            // Deleta a imagem do Storage
            Storage::delete($img[0]);

            DB::table('tb_sala_sao_paulo')
                    ->where('cd_sala_sao_paulo', '=', $id)
                    ->delete();
        }

        return redirect()->route('salas');
    }

    public function exibirSalas()
    {
        if (Auth::user() == null)
            return view('auth/login');
        
        return view('salas/salas');
    }

    public function salasAssincronas()
    {
        session_start();

        $email = $_SESSION['usuario'];

        // Atualiza status do usuário logado para online
        DB::table('users')
                ->where('email', $email)
                ->update(['status' => 'online']);

        if ($_SESSION['santos']) {
            $dadosSantos = DB::table('tb_sala_santos')
                            ->select('cd_sala_santos', 'nm_sala',  'img_sala')
                            ->get();

            $dadosSala = $dadosSantos;

            $usuarios = DB::table('users')
                            ->leftJoin('tb_sala_santos', 'users.cd_sala_santos', '=', 'tb_sala_santos.cd_sala_santos')
                            ->select('users.name', 'users.status', 'tb_sala_santos.nm_sala')
                            ->orderBy('users.status')
                            ->get();

        } else { 
            $dadosSaoPaulo = DB::table('tb_sala_sao_paulo')
                            ->select('cd_sala_sao_paulo', 'nm_sala',  'img_sala')
                            ->get();
            
            $dadosSala = $dadosSaoPaulo;

            $usuarios = DB::table('users')
                            ->leftJoin('tb_sala_sao_paulo', 'users.cd_sala_sao_paulo', '=', 'tb_sala_sao_paulo.cd_sala_sao_paulo')
                            ->select('users.name', 'users.status', 'tb_sala_sao_paulo.nm_sala')
                            ->orderBy('users.status')
                            ->get();
        }

        return response()->json(["sala" => $dadosSala, "usuarios" => $usuarios]);
    }
} // Fim da class
