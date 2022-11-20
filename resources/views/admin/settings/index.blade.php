@extends('adminlte::page')

@section('title', 'Configurações Gerais')

@section('content_header')
    <h1>Configurações Gerais</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ Route('admin.settings.store') }}" method="POST">
            @csrf
            <x-adminlte-card title="Configurações" theme="lightblue">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" required name="title" id="title" placeholder="{{ $settings->title }}" value="{{ $settings->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" required name="description" id="description" placeholder="{{ $settings->description }}" value="{{ $settings->description }}">
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="d-block ml-auto" type="submit" label="Salvar" theme="primary" />
                </x-slot>
            </x-adminlte-card>
        </form>
    </div>
@stop
