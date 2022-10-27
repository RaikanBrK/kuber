<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;


class Teste extends Component
{
    use LivewireAlert;

    public function createAlertError()
    {
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'User Created Successfully!']);
    }

    public function render()
    {
        return view('livewire.teste');
    }
}
