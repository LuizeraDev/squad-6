<!-- Herdando o conteúdo da master_page.blade aonde fica o nosso layout de páginas -->
@extends('layouts.master_page')

<!-- Passando o nome do título da página -->
@section('titulo', 'Fifo - Login')

<!-- Indicamos o inicio do conteúdo -->
@section('conteudo')
<form action="entrando" method="POST">
<!-- Este token é necessário para utilizar POST -->
{{ csrf_field() }}
<p>
<h3>Login</h3>
Usuário 
<input type="text" placeholder="Usuário" name="usuario"><br><br>
Senha
<input type="password" placeholder="Senha" name="senha"><br>
<br><br>
<input type="submit" value="Entrar">
</p>
<a href="cadastro">Não possuo uma conta</a>
</form>
@stop