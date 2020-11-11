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
        if (!Auth::user())
            return view('auth/login');

        if (isset($_SESSION)) {
            session_destroy();
        } else {
            session_start();
            $email = $_SESSION['usuario'];
            $_SESSION['santos'] = true;
            $_SESSION['saopaulo'] = false;

            // Atualiza status do usuário logado para online, e a unidade do usuário para santos
            DB::table('users')
                    ->where('email', $email)
                    ->update(['status' => 'online', 'unidade' => 'santos']);
        }

        return redirect()->route('salas');
    }

    public function salasaoPaulo()
    {
        if (!Auth::user())
            return view('auth/login');

        if (isset($_SESSION)) {
            session_destroy();
        } else {
            session_start();
            $email = $_SESSION['usuario'];
            $_SESSION['santos'] = false;
            $_SESSION['saopaulo'] = true;

            // Atualiza status do usuário logado para online, e a unidade do usuário para santos
            DB::table('users')
                    ->where('email', $email)
                    ->update(['status' => 'online', 'unidade' => 'sao_paulo']);
        }

        return redirect()->route('salas');
    }

    public function cadastrarSala(Request $request)
    {
        session_start();

        if (!Auth::user())
            return view('auth/login');

        $validate = $request->validate([
            'nomeSala' => 'alpha_dash'
        ]);

        $nome = $request->input('nomeSala');

        if (!$nome) {
            $erroNomeVazio = "Você não botou nenhum nome para a sala";
            return view('salas/criarSala', ['nome_vazio' => $erroNomeVazio]);
        }
        
        if ($request->file('ImagemSala')) {
            $img = $request->file('ImagemSala')->store('img_sala');
           
            $extensao = $request->file('ImagemSala')->extension();
           
            if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
                $erroFile = "Você deve anexar um arquivo jpg ou png.";
                return view('salas/criarSala', ['MsgErroFile' => $erroFile]);
           }
        }
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

        if (!Auth::user())
            return view('auth/login');

        if ($_SESSION['santos']) {
            $usuarios_na_sala = DB::table('users')
                                ->join('tb_sala_santos', 'tb_sala_santos.cd_sala_santos', '=', 'users.cd_sala_santos')
                                ->select('tb_sala_santos.nm_sala','users.cd_fila_usuario')
                                ->get(); 

            $pessoas_na_sala = count($usuarios_na_sala);

            if ($pessoas_na_sala > 0) { 
                $erro = "Não é possível excluir salas com usuários dentro.";
                return view('salas/excluirSala', ['nomeSala' => $nomeSala, 'salaId' => $id ,'MsgErro' => $erro]);
            } else {            
                // Verifica o nome da foto no banco para ser deletada em seguida
                $img = DB::table('tb_sala_santos')
                                    ->select('img_sala')
                                    ->where('cd_sala_santos', '=', $id)
                                    ->pluck('img_sala');
            
                // Deleta a imagem do Storage
                Storage::delete($img[0]);

                DB::table('tb_sala_santos')
                            ->where('cd_sala_santos', '=', $id)
                            ->delete();
            }
        } else {
            $usuarios_na_sala = DB::table('users')
                                    ->join('tb_sala_sao_paulo', 'tb_sala_sao_paulo.cd_sala_sao_paulo', '=', 'users.cd_sala_sao_paulo')
                                    ->select('tb_sala_sao_paulo.nm_sala','users.cd_fila_usuario')
                                    ->get(); 
            
            $pessoas_na_sala = count($usuarios_na_sala);

            if ($pessoas_na_sala > 0) { 
                $erro = "Não é possível excluir salas que tenham pessoas dentro.";
                return view('salas/excluirSala', ['nomeSala' => $nomeSala, 'salaId' => $id ,'MsgErro' => $erro]);
            } else { 
                     // Verifica o nome da foto no banco para ser deletada em seguida
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
       
        }

        return redirect()->route('salas');
    }

    public function exibirSalas()
    {
        if (!Auth::user())
            return view('auth/login');

        return view('salas/salas');
    }

    public function salasAssincronas()
    {
        session_start();

        if ($_SESSION['santos']) {
            $dadosSala = DB::table('tb_sala_santos')
                            ->select('cd_sala_santos', 'nm_sala',  'img_sala')
                            ->get();
            
            $qt_usuarios = DB::table('users')
                                ->join('tb_sala_santos', 'tb_sala_santos.cd_sala_santos', '=', 'users.cd_sala_santos')
                                ->select('tb_sala_santos.nm_sala')
                                ->get();

            $usuarios = DB::table('users')
                            ->leftJoin('tb_sala_santos', 'users.cd_sala_santos', '=', 'tb_sala_santos.cd_sala_santos')
                            ->select('users.name', 'users.status', 'users.unidade', 'tb_sala_santos.nm_sala')
                            ->orderBy('users.status')
                            ->get();

        } else { 
            $dadosSala = DB::table('tb_sala_sao_paulo')
                            ->select('cd_sala_sao_paulo', 'nm_sala',  'img_sala')
                            ->get();

            $qt_usuarios = DB::table('users')
                            ->join('tb_sala_sao_paulo', 'tb_sala_sao_paulo.cd_sala_sao_paulo', '=', 'users.cd_sala_sao_paulo')
                            ->select('tb_sala_sao_paulo.nm_sala')
                            ->get(); 

            $usuarios = DB::table('users')
                            ->leftJoin('tb_sala_sao_paulo', 'users.cd_sala_sao_paulo', '=', 'tb_sala_sao_paulo.cd_sala_sao_paulo')
                            ->select('users.name', 'users.status', 'users.unidade', 'tb_sala_sao_paulo.nm_sala')
                            ->orderBy('users.status')
                            ->get();
        }

        return response()->json(["sala" => $dadosSala, "usuarios" => $usuarios, "qt_usuarios" => $qt_usuarios]);
    }
} // Fim da class
