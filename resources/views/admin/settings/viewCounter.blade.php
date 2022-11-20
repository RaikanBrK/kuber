@extends('adminlte::page')

@section('title', 'Contador de visitas')

@section('content_header')
    <h1>Configurar contador de visitas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.settings.viewCounter.store') }}" method="post">
            @csrf            
            <x-adminlte-card title="Contador de visitas" theme="lightblue">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="toggleViewCounter" name="toggleViewCounter"
                        @checked($settings->view_counter)>
                    <label class="custom-control-label" for="toggleViewCounter">Ativar/Desativar contador de
                        visitas</label>
                </div>

                <div class="form-group mt-3 col-sm-7">
                    <div class="d-flex">
                        <label for="periodCountVisits">Perído para nova visita <span
                                class="text-muted">(horas)</span></label>
                        <a role="button" class="ml-auto" data-toggle="popover" title="Período de nova visita"
                            data-content="Você pode alterar o período que o contador leva para contabilizar uma nova visita para o mesmo usuário. O contador só contabilizará uma nova visita para os usuários que voltarem no site após o período determinado.">
                            <i class="far fa-question-circle" class="p-2" style="font-size: 1.3rem"></i>
                        </a>
                    </div>
                    <input type="number" id="periodCountVisits" name="period_count_visits" class="form-control"
                        max="24" min="1" value="{{ $settings->period_count_visits }}" required>
                </div>

                <x-slot name="footerSlot">
                    <x-adminlte-button class="d-block ml-auto" type="submit" label="Salvar" theme="primary" />
                </x-slot>
            </x-adminlte-card>
        </form>
    </div>
@stop

@section('js')
    @vite('resources/js/kuber/popover.js')
@stop
