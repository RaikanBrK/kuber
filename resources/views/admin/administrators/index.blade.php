@extends('adminlte::page')

@section('title', 'Administradores')

@section('content_header')
    <h1>Todos Administradores</h1>
@stop

@section('content')
    <livewire:kuber.datatables theadDark tableHover :data="$users" :header="$header" actions route="administrators" />
@stop
