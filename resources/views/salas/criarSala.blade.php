<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Fifo - Criar Sala</title>
	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	@livewireStyles

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>

<body>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> <!--- GRID -->
	<!-- form que aceita arquivos -->
	<form action='cadastrandosala' method="post" enctype="multipart/form-data">
		@csrf
		<p>Criar Sala</p>
		<p>Nome: <input type="text" id="nome" name="nomeSala"></p>
		<p>Selecione uma Imagem </p>
		<p><input type="file" name="ImagemSala"></p>
		<p><input type="submit" value="Criar Sala"></p>

		@if (isset($nome_vazio))
		<p>Erros encontrados:</p>
		<p>{{$nome_vazio}}</p>
		@endif

		@if (isset($MsgErro) && isset($MsgErroFoto))
		<p>Erros encontrados:</p>
		<p>{{$MsgErro}} <br> {{$MsgErroFoto}}</p>

		@elseif (isset($MsgErro))
		<p>Erros encontrados:</p>
		<p>{{$MsgErro}}</p>

		@elseif (isset($MsgErroFoto))
		<p>Erros encontrados: </p>
		<p>{{$MsgErroFoto}}</p>

		@elseif (isset($erroFile))
		<p>Erros encontrados: </p>
		<p>{{$erroFile}}</p>
		@endif
		@if (isset($MsgErroFile))
		<p>Erro {{$MsgErroFile}}</p>
		@endif


		<!-- Jquery necessário para validação do campo -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.js"></script>

		<script>
			// Troca o valor da barra de espaço por um underline
			$('#nome').on("input", function(e) {
				$(this).val($(this).val().replace(" ", "_"));
			});
		</script>

		<a href="salas">Voltar as salas</a>
	</form>
</body>

</html>