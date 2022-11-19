@extends('adminlte::page')

@section('title', 'Alterar logo e favicon')

@section('content_header')
    <h1>Alterar logo e favicon</h1>
@stop

@section('content')
    <div class="container-fluid" id="logoFaviconCards">

        <form action="{{ route('admin.settings.logoFavicon.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-adminlte-card title="Logo" theme="lightblue">
                <div class="row">
                    <div class="col-sm-4 col-md-3 col-lg-2 mb-4 mb-sm-0 content-img">
                        <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="img-fluid logo" id="imageLogo">
                    </div>
                    <div class="col">
                        <x-adminlte-input-file name="logo" igroup-size="sm" placeholder="Selecione a logo...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                        <small id="emailHelp" class="form-text text-muted">Recomendado: 250 x 150 px</small>
                    </div>
                </div>
            </x-adminlte-card>
    
            <x-adminlte-card title="Favicon" theme="lightblue">
                <div class="row">
                    <div class="col-sm-4 col-md-3 col-lg-2 mb-4 mb-sm-0 content-img">
                        <img src="{{ asset('images/favicon.webp') }}" alt="Favicon" class="img-fluid favicon" id="imageFavicon">
                    </div>
                    <div class="col">
                        <x-adminlte-input-file name="favicon"  igroup-size="sm" placeholder="Selecione o favicon...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                        <small id="emailHelp" class="form-text text-muted">Recomendado: 144 x 144 px</small>
                    </div>
                </div>
            </x-adminlte-card>
    
            <x-adminlte-button class="d-block ml-auto" type="submit" label="Salvar" theme="success" />
        </form>
        
    </div>
@stop

@section('css')
@vite('resources/sass/admin/settings/logoFavicon.scss')
@stop

@section('js')
@vite('resources/js/admin/settings/logoFavicon.js')
@stop