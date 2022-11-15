@php($adminMaster = $data->find($item['id'])->hasRole('admin-master'))
<tr class="
    kuber-table-tr
    @if ($adminMaster) table-primary
    @else
        @if (auth()->user()->id == $item['id']) table-active @endif
    @endif
    "
    wire:key="{{ $item['id'] }}" data-kuberIdItem="{{ $item['id'] }}">
    @foreach ($itemsKeys as $key)
        <td class="kuber-table-td">
            @if ($key == 'id' && $adminMaster)
                <i class="fas fa-crown text-warning mr-2"></i>
            @endif
            @if ($key == 'name')
                <img src="{{ $this->data->find($item['id'])->image() }}" alt="{{ $item[$key] }}"
                    class="img-fluid img-circle mr-2 border border-dark" style="width: 30px">
            @endif
            {{ $item[$key] }}
        </td>
    @endforeach

    @include('kuber.datatables.table-actions')
</tr>
