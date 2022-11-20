@extends('adminlte::page')

@section('title', 'Criar Administradores')

@section('content_header')
    <h1>Criar Administradores</h1>
@stop

@section('content')
    <div class="container-fluid">
        <x-adminlte-card title="Administrador" theme="lightblue">
            <form action="{{ route('admin.administrators.store') }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-5 col-md-4">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col-sm-5 col-md-4">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                @include('admin/administrators.partials.radioGender')
                <small class="text-muted">Outras informações como foto, descrição, etc. Poderão ser alteradas após efetuar o
                    login</small>
                <x-adminlte-button class="d-block ml-auto" type="submit" label="Criar" theme="success" />
            </form>
        </x-adminlte-card>
    </div>
@stop
