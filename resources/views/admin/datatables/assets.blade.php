@if ($noAssets == false)
    @push('js')
        @if ($assetResponsive == null)
            @vite('resources/js/admin/datatables/datatables.js')
        @else
            @vite($assetResponsive)
        @endif
    @endpush
@endif