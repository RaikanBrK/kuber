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
        <tr class="kuber-table-tr" wire:key="{{ $item['id'] }}" data-kuberIdItem="{{ $item['id'] }}">
            @foreach($itemsKeys as $key)
            <td class="kuber-table-td">{{ $item[$key] }}</td>
            @endforeach
            
            @if($actions)
            <td class="kuber-datatables-actions">
                @foreach($listActionsViewer as $action)
                    @if($action['methodFormHtml'] == 'get')
                    <a href="{{ route($action['link'], [$item['identifier']]) }}" class="kuber-datatables-action kuber-datatables-action-{{ $action['action'] }}" title="{{ $action['title'] }}">
                        <i class="fas {{ $action['icon'] }}"></i>                        
                    </a>
                    @else
                    
                    <form 
                        action="{{ route($action['link'], [$item['identifier']]) }}"
                        method="{{ $action['methodFormHtml'] }}"
                    >
                        @csrf
                        @isset($action['method'])
                        @method($action['method'])
                        @endisset
                        <button type="submit" class="kuber-datatables-action kuber-datatables-action-{{ $action['action'] }}" title="{{ $action['title'] }}">
                            <i class="fas {{ $action['icon'] }}"></i>
                        </button>
                    </form>
                    @endif
                @endforeach
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@stop