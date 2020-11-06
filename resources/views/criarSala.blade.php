<!-- Herdando o conteúdo da master_page.blade aonde fica o nosso layout de páginas -->
@extends('layouts.master_page')

<!-- Passando o nome do título da página -->
@section('titulo', 'Fifo - Criar Sala')

<!-- Indicamos o inicio do conteúdo -->
@section('conteudo')

<!-- form que aceita arquivos -->
<form action= 'cadastrando' method="post" enctype="multipart/form-data">
	@csrf
<p>Criar Sala</p>
<p>Nome: <input type="text" name="nomeSala"></p>
<p>Selecione uma Imagem </p>
<p><input type="file" name="ImagemSala" ></p>
<p><input type="submit" value="Criar Sala"></p>
</form>

@stop