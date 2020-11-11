<?php session_start(); ?>
<x-app-layout>

    <x-slot name="header">            
        {{ __('Inicio') }}        
    </x-slot>


    <div class="grid">
        <div class="row">

            <div class="col-12">
                <div class="logo">
                    <h1>LOGO</h1>
                </div>
            </div>
              
            <div class="col-12">

                    <div class="menu">

                    
                        <div class="button">
                                <a href="unidade">Entrar em uma unidade</a>
                        </div>
                   
                
                    </div>
            </div> 

        </div>
    </div>
</x-app-layout>
