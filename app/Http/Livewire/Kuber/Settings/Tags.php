<?php

namespace App\Http\Livewire\Kuber\Settings;

use App\Repositories\SettingsSite\EloquentSettingsSiteRepository;
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
        return view('livewire.kuber.settings.tags');
    }

    public function updateHead()
    {
        $settingsSite = new EloquentSettingsSiteRepository();
        $settingsSite->updateHead($this->content);

        $this->alert('success', 'Tag atualizada');
    }

    public function updateBody()
    {
        $settingsSite = new EloquentSettingsSiteRepository();
        $settingsSite->updateBody($this->content);

        $this->alert('success', 'Tag atualizada');
    }
}
