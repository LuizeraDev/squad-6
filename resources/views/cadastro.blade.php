<!-- Herdando o conteúdo da master_page.blade aonde fica o nosso layout de páginas -->
@extends('layouts.master_page')

<!-- Passando o nome do título da página -->
@section('titulo', 'Cadastro')

<!-- Indicamos o inicio do conteúdo -->
@section('conteudo')
<form action="cadastrar" method="GET">
        <p>
        <h3>Cadastro</h3>
        Usuário 
        <input type="text" placeholder="Usuário" name="usuario"><br><br>
        Senha
        <input type="password" placeholder="Senha" name="senha"><br>
        <br>
        <br>
        <input type="submit" value="Cadastrar-se">
        </p>
        <a href="login">Possuo uma conta</a>
</form>
<!-- Seu respectivo fim -->
@stop

