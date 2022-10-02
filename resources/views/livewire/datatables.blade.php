@push('css')
@vite('resources/sass/kuber/datatables/datatables.scss')
@endpush

<div class="table-responsive pb-3">
    <table class="display table {{ $table }} {{ $tableClass }}" style="width:100%">

        <thead class="{{ $theadClass }}">
            <tr>
                @foreach($itemsHeader as $item)
                    <th>{{ $item }}</th>
                @endforeach

                @if($actions)
                    <th>{{ $labelAction }}</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($dataArray as $item)
            <tr>
                @foreach($itemsKeys as $key)
                <td>{{ $item[$key] }}</td>
                @endforeach
                
                @if($actions)
                <td class="kuber-datatables-actions">
                    @foreach($listActionsViewer as $action)
                        @if($action['methodFormHtml'] == 'get')
                        <a href="{{ route($action['link'], [$item['identifier']]) }}" class="kuber-datatables-action kuber-datatables-action-{{ $action['action'] }}" title="{{ $action['title'] }}">
                            <i class="fas {{ $action['icon'] }}"></i>                        
                        </a>
                        @else
                        
                        <form action="{{ route($action['link'], [$item['identifier']]) }}" method="{{ $action['methodFormHtml'] }}">
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
</div>

@if ($noAssets == false)
@push('js')
<script>
    const tableDatatables = $('.{{ $table }}');
    
    var table = null;
    var page = 0;
    var json = {!! $settings !!}

    function initDatatables(callback = null) {
        if (table != null) {
            page = table.page.info().page;
            table.destroy();
        }

        if (callback) {
            callback();
        }
        
        table = tableDatatables.DataTable(json);
        table.page( page ).draw( 'page' );
    }
</script>

@if ($assetResponsive == null)
    @vite('resources/js/kuber/datatables/datatables.js')
@else
    @vite($assetResponsive)
@endif

@endpush
@endif