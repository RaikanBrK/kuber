@extends('adminlte::page')

@section('title', 'Preferências do usuário')

@section('content_header')
    <h1>Preferências do usuário</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.profile.settings.store') }}" method="post">
            @csrf
            <x-adminlte-card title="Datatables" theme="lightblue">
                <x-adminlte-select name="countForPage" label="Resultados visualizados por página na tabela" id="countForPage"
                    label-class="text-lightblue">
                    @foreach ($countForPageAll as $item)
                        <option value="{{ $item->id }}" @selected($idCountForPageUserCurrent == $item->id)>
                            {{ $item->number }}
                        </option>
                    @endforeach
                </x-adminlte-select>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="d-block ml-auto" type="submit" label="Salvar" theme="primary" />
                </x-slot>
            </x-adminlte-card>
        </form>
    </div>
@stop

@push('css')
@endpush
