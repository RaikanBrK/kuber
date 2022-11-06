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