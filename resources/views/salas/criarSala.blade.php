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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css"
		integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA=="
		crossorigin="anonymous" />
	<link rel="stylesheet" href="{{ asset('css/criarSala.css') }}">

	@livewireStyles

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer>
	</script>
</head>

<body>
	<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
		<!--- GRID -->
		<h2>Criar Sala</h2>
		<!-- form que aceita arquivos -->
		<form
			class="flex flex-col sm:justify-center items-center w-full sm:max-w-md mt-6 px-10 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
			action='cadastrandosala' method="post" enctype="multipart/form-data">
			@csrf

			<div class="wrapperNome">
				<input type="text" id="nome" name="nomeSala" autocomplete="off" required>
				<label class="labelNome" for="nome"><span class="contentNome">Nome</span></label>
			</div>

			<div class="flex flex-col sm:justify-center items-center my-3">

				<label  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded my-3" for="upload-photo">Selecione uma Imagem</label>
				<input type="file" name="ImagemSala" id="upload-photo" />
			
			</div>

			<p>Demanda de pessoas da sala</p>

			<div class="inline-block relative w-64 my-3">
				<select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="demanda">
					<option value="1">1 pessoa</option>
					<option value="2">2 pessoas</option>
					<option value="3">3 pessoas</option>
					<option value="4">4 pessoas</option>
					<option value="5">5 pessoas</option>
					<option value="6">6 pessoas</option>
					<option value="7">7 pessoas</option>
					<option value="8">8 pessoas</option>
					<option value="9">9 pessoas</option>
					<option value="10">10 pessoas</option>
				</select>
				<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
					<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
				</div>
			</div>
			
			<div class="my-3">
				<p>Exemplo: Tem 2 controles para jogar fifa, portanto a demanda da sala fifa seria 2.</p>
			</div>

			<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded my-3"
			href="salas">Criar Sala</button>


			<!-- validação dos dados -->
			@if (isset($nome_vazio))
			<div class="erro">
				<p>Erros encontrados:</p>
				<p>{{$nome_vazio}}</p>
			</div>
			@endif

			@if (isset($MsgErro) && isset($MsgErroFoto))
			<div class="erro">
				<p>Erros encontrados:</p>
				<p>{{$MsgErro}} <br> {{$MsgErroFoto}}</p>
			</div>

			@elseif (isset($MsgErro))
			<div class="erro">
				<p>Erros encontrados:</p>
				<p>{{$MsgErro}}</p>
			</div>

			@elseif (isset($MsgErroFoto))
			<div class="erro">
				<p>Erros encontrados: </p>
				<p>{{$MsgErroFoto}}</p>
			</div>

			@elseif (isset($erroFile))
			<div class="erro">
				<p>Erros encontrados: </p>
				<p>{{$erroFile}}</p>
			</div>
			@endif

			@if (isset($MsgErroFile))
			<div class="erro">
				<p>Erro {{$MsgErroFile}}</p>
			</div>
			@endif


			<!-- Jquery necessário para validação do campo -->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.js"></script>

			<script>
				// Troca o valor da barra de espaço por um underline
				$('#nome').on("input", function (e) {
					$(this).val($(this).val().replace(" ", "_"));
				});
			</script>


		</form>
		<a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mt-6"
			href="salas">Voltar as salas</a>
	</div>
</body>

</html>