@extends('adminlte::page')

@section('title', 'Transferir Super Admin')

@section('content_header')
    <h1>Transferir Super Admin</h1>
@stop

@section('content')
    <livewire:admin.datatables.datatables-user-transfer-master theadDark tableHover :data="$users" :header="$header" actions :actionsList="['transfer']" route="administrators.transferMaster" />
@stop
