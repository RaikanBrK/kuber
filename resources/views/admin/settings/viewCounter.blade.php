@extends('adminlte::page')

@section('title', 'Contador de visitas')

@section('content_header')
    <h1>Configurar contador de visitas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Contador de visitas</h3>
            </div>

            <form action="{{ route('admin.settings.viewCounter.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="custom-control custom-switch">
                        <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            id="toggleViewCounter" 
                            name="toggleViewCounter"
                            @checked($settings->view_counter)
                            >
                        <label class="custom-control-label" for="toggleViewCounter" >Ativar/Desativar contador de visitas</label>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary ml-auto d-block">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
@stop