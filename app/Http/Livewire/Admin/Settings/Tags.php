<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Repositories\Settings\EloquentSettingsRepository;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Tags extends Component
{
    use LivewireAlert;

    public $title;

    public $onUpdate;

    public $content;

    public $placeholder = 'Adicione sua tag aqui!';

    public function render()
    {
        return view('livewire.admin.settings.tags');
    }

    public function updateHead()
    {
        $settingsSite = new EloquentSettingsRepository();
        $settingsSite->updateHead($this->content);

        $this->alert('success', 'Tag atualizada');
    }

    public function updateBody()
    {
        $settingsSite = new EloquentSettingsRepository();
        $settingsSite->updateBody($this->content);

        $this->alert('success', 'Tag atualizada');
    }
}
