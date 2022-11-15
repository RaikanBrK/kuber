@if ($actions)
    <td class="kuber-datatables-actions">
        @if($adminMaster == false)
            @foreach ($listActionsViewer as $action)
                @if ($action['methodFormHtml'] == 'get')
                    <a href="{{ route($action['link'], [$item['identifier']]) }}"
                        class="kuber-datatables-action kuber-datatables-action-{{ $action['action'] }}"
                        title="{{ $action['title'] }}">
                        <i class="fas {{ $action['icon'] }}"></i>
                    </a>
                @elseif($action['livewire'] != false)
                <button type="type" class="kuber-datatables-action kuber-datatables-action-{{ $action['action'] }}" wire:click="{{ $action['livewire'] }}({{ $item['id'] }})"
                    title="{{ $action['title'] }}">
                    <i class="fas {{ $action['icon'] }}"></i>
                </button>
                @else
                    <form action="{{ route($action['link'], [$item['identifier']]) }}"
                        method="{{ $action['methodFormHtml'] }}">
                        @csrf
                        @isset($action['method'])
                            @method($action['method'])
                        @endisset
                        <button type="submit" class="kuber-datatables-action kuber-datatables-action-{{ $action['action'] }}"
                            title="{{ $action['title'] }}">
                            <i class="fas {{ $action['icon'] }}"></i>
                        </button>
                    </form>
                @endif
            @endforeach
        @endif
    </td>
@endif
