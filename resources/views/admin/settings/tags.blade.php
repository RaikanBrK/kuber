@extends('adminlte::page')

@section('title', 'Adicionar tags')

@section('content_header')
    <h1>Adicionar tags</h1>
@stop

@section('content')
<div class="container-fluid">
    <x-adminlte-alert theme="info" title="Cuidado!" dismissable>
        Não adicione tags de terceiro, apenas se você confiar no provedor.
    </x-adminlte-alert>

    @livewire('admin.settings.tags', [
        'title' => 'Tags antes do </head>',
        'content' => $settings->head,
        'onUpdate' => 'updateHead'
    ])

    @livewire('admin.settings.tags', [
        'title' => 'Tags antes do </body>',
        'content' => $settings->body,
        'onUpdate' => 'updateBody'
    ])
</div>
@stop