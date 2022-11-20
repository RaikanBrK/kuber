@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <x-adminlte-small-box title="{{ $qtdUser }}" text="Administradores" icon="fas fa-users text-dark"
                    theme="info" />
            </div>
            @if ($settings->view_counter)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <x-adminlte-small-box title="{{ $viewsMonth }}" text="Visitas no mês" icon="fas fa-eye text-dark"
                        theme="teal" />
                </div>
            @endif
        </div>

        <div class="row">
            @php
                $classCol = $settings->view_counter ? 'col-lg-4': 'col-md-12';
                $classRow = $settings->view_counter ? 'row-cols-lg-1' : 'row-cols-md-3';
            @endphp
            @if ($settings->view_counter)
                <div class="col-lg-8 mb-4">
                    <x-adminlte-card title="Visitas" theme="purple">
                        <div>
                            <canvas id="myChartDashboard"></canvas>
                        </div>
                    </x-adminlte-card>
                </div>
            @endif
            <div class="{{ $classCol }}">
                <div class="row row-cols-1 row-cols-sm-2 {{ $classRow }}">
                    @include('admin.dashboard.info')
                </div>
            </div>
        </div>
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
