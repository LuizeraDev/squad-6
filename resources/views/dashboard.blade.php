<?php 
session_start(); 
$_SESSION['dashboard'] = true;
?>

<x-app-layout>

<div class="background w-full" alt=""></div>

<div class="body flex flex-col sm:justify-center items-center mb-4">
    <div class="greetings sm:justify-center items-center">
        <p>Veja a fila das atividades que estão rolando no escritório.</p>

        <h3>Nos diga, onde você está agora?</h3>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:justify-center items-center mb-4">
        <a class="option max-w-sm md:w-1/2 rounded overflow-hidden shadow-lg tracking-widest
                    bg-purple-600 hover:bg-purple-700 text-white font-bold border-none text-2xl rounded" href="/unidade/santos">Santos</a>
        
        <a class="option max-w-sm md:w-1/4  rounded overflow-hidden shadow-lg tracking-widest
                bg-purple-600 hover:bg-purple-700 text-white font-bold border-none text-2xl rounded" href="/unidade/saopaulo">São Paulo</a>
    </div>
</div>   

  

</x-app-layout>
