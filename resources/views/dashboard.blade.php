<?php session_start(); ?>
<x-app-layout>

    <x-slot name="header">            
        {{ __('Inicio') }}        
    </x-slot>


    <div class="grid">
        
     <div class="logo">
     <h1>LOGO</h1>
     </div>
        
        <div class="menu">

            <div class="option">
                
                    <a href="unidade">Entrar em uma unidade</a>
                

            </div>

        </div>
    </div>
</x-app-layout>
