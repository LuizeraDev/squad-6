<?php
    // Vai redirecionar a pessoa depois de um determinado tempo de acordo com o tempo no (Refresh)
    header("Refresh: 2; url=login");
?>
@extends('layouts.master_page')

@section('titulo', 'Fifo - Squad 6')

<!-- Indicamos o inicio do conteúdo -->
@section('conteudo')
<h2>Logotipo - Fifo</h2>
@stop
