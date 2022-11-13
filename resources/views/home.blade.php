@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <x-adminlte-small-box 
                    title="{{ $qtdUser }}"
                    text="Administradores"
                    icon="fas fa-users text-dark"
                    theme="info"
                />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <x-adminlte-small-box 
                    title="{{ $viewsMonth }}"
                    text="Visualizações do mês"
                    icon="fas fa-eye text-dark"
                    theme="teal"
                />
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop