<?php 
session_start(); 
$_SESSION['dashboard'] = true;
?>

<x-app-layout>
<div class="flex flex-col sm:justify-center items-center mb-4">

    <div class="greetings sm:justify-center items-center">
        <h3>Bem-vindo ao FIFO</h3>
        <p>Selecione a unidade que você está</p>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:justify-center items-center mb-4">
        <a class="option max-w-sm md:w-1/2 rounded overflow-hidden shadow-lg tracking-widest
                    bg-purple-600 hover:bg-purple-700 text-white font-bold border-none text-2xl rounded" href="/unidade/santos">Santos</a>
        
        <a class="option max-w-sm md:w-1/2  rounded overflow-hidden shadow-lg tracking-widest
                bg-purple-600 hover:bg-purple-700 text-white font-bold border-none text-2xl rounded" href="/unidade/saopaulo">São Paulo</a>
    </div>
    
</div>
  

</x-app-layout>
