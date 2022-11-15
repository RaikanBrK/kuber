@extends('adminlte::page')

@section('title', 'Preferências do usuário')

@section('content_header')
    <h1>Preferências do usuário</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datatables</h3>
            </div>

            <form action="{{ route('admin.profile.settings.store') }}" method="post">
                @csrf
                <div class="card-body">
                    {{-- With prepend slot, lg size, and label --}}
                    <x-adminlte-select name="countForPage" label="Resultados visualizados por página na tabela" id="countForPage" label-class="text-lightblue">
                        @foreach($countForPageAll as $item)
                            <option 
                                value="{{ $item->id }}"
                                @selected($idCountForPageUserCurrent == $item->id)
                            >
                                {{ $item->number }}
                            </option>
                        @endforeach
                    </x-adminlte-select>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary ml-auto d-block">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css')
@endpush
