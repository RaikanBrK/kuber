@extends('adminlte::page')

@section('title', 'Editar ' . $user->name)

@section('content_header')
    <h1>Perfil de {{ $user->name }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.profile.update', $user->id) }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="form-row mb-2">
                <div class="col-auto pr-4">
                    <div class="form-group">
                        <label for="campoImageProfile" id="labelImageProfile" class="d-flex flex-column align-items-center">
                            <img src="{{ $user->image() }}" alt="{{ $user->name }}" class="img-fluid" id="imageProfile" accept=".png, .jpg, .jpeg">
                            <small class="text-muted">Clicar para alterar</small>
                        </label>
                        <input type="file" class="d-none" id="campoImageProfile" name="image">
                    </div>
                </div>
                <div class="col">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ $user->name }}" value="{{ $user->name }}">
                        </div>
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ $user->email }}" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição</label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="{{ $user->desc() }}" value="{{ $user->desc() }}">
                    </div>
                </div>
            </div>
            @include('admin/administrators.partials.radioGender')
            @include('admin/administrators.partials.changePassword')
            <button type="submit" class="btn btn-primary ml-auto d-block">Salvar</button>
        </form>
    </div>
@stop

@push('css')
    @vite('resources/sass/kuber/admin/profile.scss')
@endpush

@push('js')
    @vite('resources/js/kuber/admin/administrators/changePassword.js')
    @vite('resources/js/kuber/admin/profile.js')
@endpush
