@extends('adminlte::page')

@section('title', 'Editar x')

@section('content_header')
    <h1>Perfil de x</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form>
            <div class="form-row mb-2">
                <div class="col-auto pr-4">
                    <div class="form-group">
                        <label for="imageProfile" id="labelImageProfile" class="d-flex flex-column align-items-center">
                            <img src="{{ $user->adminlte_image() }}" alt="" class="img-fluid">
                            <small class="text-muted">Clicar para alterar</small>
                        </label>
                        <input type="file" class="d-none" id="imageProfile" name="imageProfile">
                    </div>
                </div>
                <div class="col">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição</label>
                        <input type="text" class="form-control" id="desc" name="desc">
                    </div>
                </div>
            </div>
            @include('admin/administrators.partials.changePassword')
            <button type="submit" class="btn btn-primary ml-auto d-block">Salvar</button>
        </form>
    </div>
@stop

@push('js')
    @vite('resources/js/admin/administrators/changePassword.js')
@endpush
