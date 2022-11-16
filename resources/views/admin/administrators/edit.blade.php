@extends('adminlte::page')

@section('title', "Editar administrador {$user->name}")

@section('content_header')
    <h1>Editar administrador <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="container">

        <form action="{{ route('admin.administrators.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        placeholder="{{ $user->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        placeholder="{{ $user->email }}">
                </div>
            </div>
            @include('admin/administrators.partials.radioGender')
            @include('admin.administrators.partials.changePassword')
            
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.administrators.index') }}" class="btn btn-sm btn-info">Voltar</a>
                <button type="submit" class="btn btn-outline-primary">Editar</button>
            </div>
        </form>
    </div>
@stop

@push('js')
    @vite('resources/js/admin/administrators/changePassword.js')
@endpush
