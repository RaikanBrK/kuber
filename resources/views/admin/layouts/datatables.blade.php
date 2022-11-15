@push('css')
@vite('resources/sass/kuber/datatables/datatables.scss')
@endpush

<div class="container-datatables">
    @include('admin.datatables.search')

    <div class="table-responsive pb-3">
        @yield('table')
    </div>

    @include('admin.datatables.pagination')
</div>

@include('admin.datatables.assets')