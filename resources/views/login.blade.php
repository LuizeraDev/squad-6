<!-- Herdando o conteúdo da master_page.blade aonde fica o nosso layout de páginas -->
@extends('layouts.master_page')

<!-- Passando o nome do título da página -->
@section('titulo', 'Cadastro')

<!-- Indicamos o inicio do conteúdo -->
@section('conteudo')
<form action="../funcionalidades/fazer-login.php" method="POST">
    <p>
        <h3>Login</h3>
        Usuário 
        <input type="text" placeholder="Usuário" name="usuario"><br><br>
        Senha
        <input type="password" placeholder="Senha" name="senha"><br>
        <br>
        <br>
        <input type="submit" value="Entrar">
    </p>
    <a href="cadastro">Não possuo uma conta</a>
</form>
@stop