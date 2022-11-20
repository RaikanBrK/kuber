<div class="form-row justify-content-between">
    <div class="form-group col-md-4 d-flex align-items-center">
        <label for="countForPage" class="d-flex">
            Exibir
            <select id="countForPage" wire:model="countForPage">
                @foreach($countForPageAll as $item)
                    <option value="{{ $item->number }}" >{{ $item->number }}</option>
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