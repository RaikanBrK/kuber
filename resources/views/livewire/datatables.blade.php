@push('css')
@vite('resources/sass/kuber/datatables/datatables.scss')
@endpush

<div class="form-group">
    <label for="busca" class="form-label">Pesquisar</label>
    <input type="text" class="form-control buscaInput" id="busca">
</div>

<div class="table-responsive pb-3">
    <table class="display table {{ $table }} {{ $tableClass }}" style="width:100%">

        <thead class="kuber-table-thead {{ $theadClass }}">
            <tr>
                @foreach($itemsHeader as $item)
                    <th class="kuber-table-th">{{ $item }}</th>
                @endforeach

                @if($actions)
                    <th>{{ $labelAction }}</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($dataArray as $item)
            <tr class="kuber-table-tr">
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

</script>

@if ($assetResponsive == null)
    @vite('resources/js/kuber/datatables/datatables.js')
@else
    @vite($assetResponsive)
@endif

@endpush
@endif