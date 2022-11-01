<?php

namespace App\Http\Livewire\Kuber;

use App\Http\Livewire\Kuber\datatables\ComponentDatatables;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DatatablesUserTransferMaster extends ComponentDatatables
{
    use LivewireAlert;
    
    protected $listeners = ['confirmed', 'cancel'];

    public function modal()
    {
        $this->alert('warning', 'Transferir Super Admin?', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'Sim, transferir!',
            'showCancelButton' => true,
            'onDismissed' => 'cancel',
            'cancelButtonText' => 'Não. Permanecer como Super Admin',
            'text' => 'Cuidado!!! Essa é uma ação irreversível.',
        ]);           
    }

    public function confirmed()
    {
        $this->alert('success', 'Sucesso');
    }

    public function cancel()
    {
        $this->alert('info', 'Nop');
    }

    public function render()
    {
        return view('livewire.kuber.datatables-user-transfer-master');
    }
}
