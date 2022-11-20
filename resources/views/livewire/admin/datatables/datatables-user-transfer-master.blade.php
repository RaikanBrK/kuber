@extends('admin.layouts.datatables')

@section('table')

<table class="display table {{ $table }} {{ $tableClass }}" style="width:100%">

    <thead class="kuber-table-thead {{ $theadClass }}">
        <tr>
            @php($indexHeader = 0)
            @foreach($itemsHeader as $item)
                <th class="kuber-table-th" data-kuberId="{{ $indexHeader }}">{{ $item }}</th>
                @php($indexHeader++)
            @endforeach

            @if($actions)
                <th>{{ $labelAction }}</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach($dataArray as $idx => $item)
        @include('admin.datatables.linesTr')
        @endforeach
    </tbody>
</table>
@stop
