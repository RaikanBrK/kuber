<div class="table-responsive pb-3">
    <table class="display table {{ $table }} {{ $tableClass }}" style="width:100%">

        @if (isset($thead))
            {{ $thead }}
        @else
        <thead class="{{ $theadClass }}">
            <tr>
                @foreach($itemsHeader as $item)
                    <th>{{ $item }}</th>
                @endforeach
            </tr>
        </thead>
        @endif

        @if($slot->isEmpty())
        <tbody>
            @foreach($dataArray as $item)
            <tr>
                @foreach($itemsKeys as $key)
                <td>{{ $item[$key] }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
        @else
        {{ $slot }}
        @endif

        @if (isset($tfoot))
            {{ $tfoot }}
        @endif
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