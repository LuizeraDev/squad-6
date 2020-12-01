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
	<link rel="stylesheet" href="{{ asset('css/global.css') }}">

	@livewireStyles

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer>
	</script>
</head>

<body class="logoBG"> 

<div class="">
	<!--- GRID -->	
	<div class="ajuste min-h-screen flex flex-col items-center pt-6 sm:pt-0">

		<!-- form que aceita arquivos -->
		<form
			class="flex flex-col sm:justify-center items-center w-full sm:max-w-md mt-6 px-10 py-4 bg-white shadow-md overflow-hidden"
			action='cadastrandosala' method="post" enctype="multipart/form-data">
			@csrf	

			<img src="../assets/Logo3.png" alt="Logo">

			<h3>CADASTRO DE NOVA ATIVIDADE</h3>

			<div class="wrapperNome">
				<input type="text" id="nome" name="nomeSala" autocomplete="off" required>
				<label class="labelNome" for="nome"><span class="contentNome">Nome da atividade</span></label>
			</div>

			<div class="flex flex-col sm:justify-center items-center my-3">

				<label
					class="corBotoes"
					for="upload-photo">Selecione uma Imagem</label>
				<input type="file" name="ImagemSala" id="upload-photo" />

			</div>

			<p>Demanda de pessoas da sala</p>

			<div class="">
				<select
					class="corBotoes"
					name="demanda">
					<option value="1">1 PESSOA - ATIVIDADE INDIVIDUAL</option>
					<option value="2">2 PESSOAS</option>
					<option value="3">3 PESSOAS</option>
					<option value="4">4 PESSOAS</option>
					<option value="5">5 PESSOAS</option>
					<option value="6">6 PESSOAS</option>
					<option value="7">7 PESSOAS</option>
					<option value="8">8 PESSOAS</option>
					<option value="9">9 PESSOAS</option>
					<option value="10">10 PESSOAS</option>
				</select>
				<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
					<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
				</div>
			</div>

			<div class="my-3">
				<p>A "demanda de pessoas da sala" deve corresponder a quantidade de pessoas "por vez".</p>
				<p>Exemplo: ao jogar FIFA, há duas pessoas por vez.</p>
			</div>

			<button type="submit" class="corBotoes corCadastrar"
				href="salas">Cadastrar Atividade</button>
			
			<a class="corBotoes voltar"
			href="salas">Voltar</a>


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


		</form> <!-- Fim form -->




</div>
</body>

</html>