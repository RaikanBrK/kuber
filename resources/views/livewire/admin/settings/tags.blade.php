<form action="{{ route('admin.settings.tags') }}" wire:submit.prevent="{{ $onUpdate }}">
    @csrf

    <x-adminlte-card :title="$title" theme="lightblue">
        <x-adminlte-textarea name="taDisabled" placeholder="{{ $placeholder }}" rows="5" wire:model="content">
            {{ $content }}
        </x-adminlte-textarea>
        <x-slot name="footerSlot">
            <x-adminlte-button class="d-block ml-auto" type="submit" label="Salvar" theme="primary" />
        </x-slot>
    </x-adminlte-card>
</form>
