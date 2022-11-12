<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{!! $title !!}</h3>
    </div>

    <form action="{{ route('admin.settings.tags') }}" wire:submit.prevent="{{ $onUpdate }}">
        @csrf
        <div class="card-body">
            <x-adminlte-textarea name="taDisabled" placeholder="{{ $placeholder }}" rows="5" wire:model="content">
                {{ $content }}
            </x-adminlte-textarea>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary ml-auto d-block">Atualizar</button>
        </div>
    </form>
</div>
