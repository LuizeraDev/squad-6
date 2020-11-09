<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fifo - Squad 6</title>
    <link rel="stylesheet" href="{{ asset('css/unidade.css') }}">
    
</head>

<body>

<div class="grid">

    <div class="logo">
        <h1>LOGO</h1>
    </div>


        <!-- No php, pegamos dados através do campo "name" dos inputs -->
        <div class="menu" >

        <div class="titleWrapper">
            <p>Escolha a unidade em que você está</p>
        </div>

            <div class="option">
                <a href="/unidade/santos">Santos</a> 
            </div>
            
            <div class="option">
                <a href="/unidade/saopaulo">São Paulo</a>
            </div>

            <div class="button">
                <a href="dashboard">Sair</a>
            </div>
        </div>
</div>
</body>
</html>