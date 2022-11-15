@if ($noAssets == false)
    @push('js')
        @if ($assetResponsive == null)
            @vite('resources/js/kuber/datatables/datatables.js')
        @else
            @vite($assetResponsive)
        @endif
    @endpush
@endif