@extends('adminlte::page')

@section('title', 'Administradores')

@section('content_header')
    <h1>Todos Administradores</h1>
@stop

@section('content')
    <x-adminlte-card title="Administradores" theme="lightblue">
        <livewire:admin.datatables.datatables-user theadDark tableHover :data="$users" :header="$header" actions route="admin.administrators" :actionsExcept="['viewer']" />
    </x-adminlte-card>
@stop
