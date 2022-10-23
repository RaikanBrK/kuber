@push('css')
@vite('resources/sass/kuber/datatables/datatables.scss')
@endpush

<div class="container-datatables">
    <div class="form-row justify-content-between">
        <div class="form-group col-md-4 d-flex align-items-center">
            <label for="countForPage" class="d-flex">
                Exibir
                @php($select = ["10", "25", "50", "100"])
                <select id="countForPage" wire:model="countForPage">
                    @foreach($select as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
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