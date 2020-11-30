<?php 
session_start(); 
$_SESSION['dashboard'] = true;
?>

<x-app-layout>

<div class="body">
    <div class="greetings">
        <h3>Veja a fila das atividades que estão rolando no escritório.</h3>

        <p>Nos diga, onde você está agora?</p>
    </div>

    
        <a class="option1" href="/unidade/santos">Santos</a>
        
        <a class="option2" href="/unidade/saopaulo">São Paulo</a>
   
  
</div>   

  

</x-app-layout>
