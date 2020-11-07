<?php 
	session_start();
?>

<!-- form que aceita arquivos -->
<form action= 'cadastrandosala' method="post" enctype="multipart/form-data">
@csrf
<p>Criar Sala</p>
<p>Nome: <input type="text" name="nomeSala"></p>
<p>Selecione uma Imagem </p>
<p><input type="file" name="ImagemSala" ></p>
<p><input type="submit" value="Criar Sala"></p>
</form>
