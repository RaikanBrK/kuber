@extends('adminlte::page')

@section('title', 'Adicionar tags')

@section('content_header')
    <h1>Adicionar tags</h1>
@stop

@section('content')
<div class="container-fluid">
    @livewire('kuber.settings.tags', [
        'title' => 'Tags antes do <b>&#60;/head&#62;</b>',
        'onUpdate' => 'updateHead'
    ])

    @livewire('kuber.settings.tags', [
        'title' => 'Tags antes do <b>&#60;/body&#62;</b>',
        'onUpdate' => 'updateBody'
    ])
</div>
@stop