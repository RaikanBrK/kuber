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
            @if ($settings->view_counter)
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
            @endif

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <img src="{{ asset('storage/' . $user->image) }}" class="mr-3 user-image img-circle elevation-2" alt="..." width="92px">
                            <div class="media-body">
                                <h5 class="card-title mt-0 float-none">{{ $user->name }} <small class="text-muted">({{ $roleName }})</small></h5>
                                <p>{{ $user->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Configurações gerais
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $settings->title }}</h5>
                        <p class="card-text">{{ $settings->description }}</p>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Contador de visitas
                        <span class="badge badge-primary badge-pill">{{ $labelViewCounter }}</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Perído de {{ $settings->period_count_visits }} horas para nova visita</p>
                        <a href="{{ route('admin.settings.viewCounter') }}" class="btn btn-primary">Editar</a>
                    </div>
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
