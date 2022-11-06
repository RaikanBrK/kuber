@push('css')
@vite('resources/sass/kuber/datatables/datatables.scss')
@endpush

<div class="container-datatables">
    @include('kuber.datatables.search')

    <div class="table-responsive pb-3">
        @yield('table')
    </div>

    @include('kuber.datatables.pagination')
</div>

@include('kuber.datatables.assets')