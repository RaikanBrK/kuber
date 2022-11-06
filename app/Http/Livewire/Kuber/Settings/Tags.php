<?php

namespace App\Http\Livewire\Kuber\Settings;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Tags extends Component
{
    use LivewireAlert;

    public $title;

    public $onUpdate;

    public function render()
    {
        return view('livewire.kuber.settings.tags');
    }

    public function updateHead()
    {
        $this->alert('info', 'atualizando head...');
    }

    public function updateBody()
    {
        $this->alert('info', 'atualizando body...');
    }
}
