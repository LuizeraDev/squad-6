<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<!-- form que aceita arquivos -->

<div class="gridLogin">

<div class="logo">
	<h1>LOGO</h1>
</div>

	<div class="formContainer">

		<section class="formWrapper">

			<form action= 'cadastrandosala' method="post" enctype="multipart/form-data">
			@csrf

				<h1>Criar Sala</h1>

				<div class="name">
					<label for="nomeSala"> Nome </label>
					<input type="text" name="nomeSala"></p>
				</div>

				<div class="imagem">
					<label for="ImagemSala"> Imagem </label>
					<input type="file" name="ImagemSala" >
				</div>


				<input type="submit" value="Criar Sala">

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
				
				<div class="buttonVoltar">
					<a href="salas">Voltar as salas</a>
				</div>

			</form>
		</section>

	</div>

</div>