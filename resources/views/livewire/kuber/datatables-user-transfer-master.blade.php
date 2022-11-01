@extends('kuber.layout-datatables')

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
        @php($adminMaster = $data->find($item['id'])->hasRole('admin-master'))
        <tr 
            class="
                kuber-table-tr
                @if($adminMaster)
                    table-primary
                @else
                    @if(auth()->user()->id == $item['id']) table-active @endif
                @endif
            "
            wire:key="{{ $item['id'] }}" 
            data-kuberIdItem="{{ $item['id'] }}"
        >
            @foreach($itemsKeys as $key)
            <td class="kuber-table-td"
                >
                @if($key == 'id' && $adminMaster)
                <i class="fas fa-crown text-warning mr-2"></i>
                @endif
                @if($key == 'name')
                    <img src="https://picsum.photos/300/300" alt="{{ $item[$key] }}" class="img-fluid img-circle mr-2 border border-dark" style="width: 30px">
                @endif
                {{ $item[$key] }}
            </td>
            @endforeach
            
            @include('kuber.datatables.table-actions')
        </tr>
        @endforeach
    </tbody>
</table>
@stop
