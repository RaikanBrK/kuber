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
            @if ($settings->view_counter)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <x-adminlte-small-box 
                    title="{{ $viewsMonth }}"
                    text="Visitas no mês"
                    icon="fas fa-eye text-dark"
                    theme="teal"
                />
            </div>
            @endif
        </div>

        @if ($settings->view_counter)
        <div class="row">
            <div class="col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Visitas</h3>
                    </div>
            
                    <div class="card-body">
                        <div>
                            <canvas id="myChartDashboard"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@stop

@section('js')
    @if ($settings->view_counter)
    <script>
        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};
    </script>

    @vite('resources/js/admin/dashboard.js')
    @endif
@stop