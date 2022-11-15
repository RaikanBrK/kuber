@extends('admin.layout-datatables')

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
        <tr class="kuber-table-tr" wire:key="{{ $item['id'] }}" data-kuberIdItem="{{ $item['id'] }}">
            @foreach($itemsKeys as $key)
            <td class="kuber-table-td">{{ $item[$key] }}</td>
            @endforeach
            
            @include('admin.datatables.table-actions')
        </tr>
        @endforeach
    </tbody>
</table>
@stop