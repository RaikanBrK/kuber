<div class="col">
    <x-adminlte-card>
        <div class="media">
            <img src="{{ asset('storage/' . $user->image) }}" class="mr-3 user-image img-circle elevation-2"
                alt="..." width="92px">
            <div class="media-body">
                <h5 class="card-title mt-0 float-none">{{ $user->name }} <small
                        class="text-muted">({{ $roleName }})</small></h5>
                <p>{{ $user->description }}</p>
            </div>
        </div>
    </x-adminlte-card>
</div>

<div class="col">
    <x-adminlte-card title="Configurações gerais" collapsible removable>
        <h5 class="card-title">{{ $settings->title }}</h5>
        <p class="card-text">{{ $settings->description }}</p>
        <x-slot name="footerSlot">
            <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">Editar</a>
        </x-slot>
    </x-adminlte-card>
</div>

<div class="col">
    <x-adminlte-card title="Contador de visitas" collapsible removable>
        <x-slot name="toolsSlot">
            <span class="badge badge-primary badge-pill">{{ $labelViewCounter }}</span>
        </x-slot>
        <p class="card-text">Perído de {{ $settings->period_count_visits }} horas para nova visita</p>
        <x-slot name="footerSlot">
            <a href="{{ route('admin.settings.viewCounter') }}" class="btn btn-primary">Editar</a>
        </x-slot>
    </x-adminlte-card>
</div>