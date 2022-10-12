@push('css')
@vite('resources/sass/kuber/datatables/datatables.scss')
@endpush

<div class="container-datatables">
    <div class="form-row justify-content-between">
        <div class="form-group col-md-4 d-flex align-items-center">
            <label for="countForPage" class="d-flex">
                Exibir
                <select id="countForPage">
                    <option selected value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                resultados por página
            </label>
        </div>
        <div class="form-group col-md-5 d-flex align-items-center">
            <label for="busca" class="form-label mr-3">Pesquisar</label>
            <input type="text" class="form-control" id="search">
        </div>
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

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end m-0 pb-3" id="paginationDatatables">
        </ul>
    </nav>
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