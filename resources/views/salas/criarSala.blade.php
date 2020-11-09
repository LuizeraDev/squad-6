<!-- form que aceita arquivos -->
<form action= 'cadastrandosala' method="post" enctype="multipart/form-data">
@csrf
<p>Criar Sala</p>
<p>Nome: <input type="text" name="nomeSala"></p>
<p>Selecione uma Imagem </p>
<p><input type="file" name="ImagemSala" ></p>
<p><input type="submit" value="Criar Sala"></p>

@if (isset($MsgErro) && isset($MsgErroFoto))
	<p>Erros encontrados:</p>
	<p>{{$MsgErro}} <br> {{$MsgErroFoto}}</p>
@elseif (isset($MsgErro)) 
	<p>Erros encontrados:</p>
	<p>{{$MsgErro}}</p>
@elseif (isset($MsgErroFoto))
	<p>Erros encontrados: </p>
	<p>{{$MsgErroFoto}}</p>
@endif

<a href="salas">Voltar as salas</a>
</form>
