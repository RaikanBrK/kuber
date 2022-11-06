<?php

namespace App\Http\Livewire\Kuber;

use App\Http\Livewire\Kuber\datatables\ComponentDatatables;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Route;

class DatatablesUserTransferMaster extends ComponentDatatables
{
    use LivewireAlert;
    
    protected $listeners = ['confirmed', 'cancel'];

    public $idUser;

    public function modal($id = null)
    {
        $this->alert('warning', 'Transferir Super Admin?', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'Sim, transferir!',
            'showCancelButton' => true,
            'cancelButtonText' => 'Não. Permanecer como Super Admin',
            'text' => 'Cuidado!!! Essa é uma ação irreversível.',
        ]);
        $this->idUser = $id;
    }

    public function confirmed()
    {
        if (Auth::check() && Auth::user()->hasRole('admin-master')) {
            User::find($this->idUser)->assignRole('admin-master');
            Auth::user()->removeRole('admin-master');

            return redirect()->route('admin.administrators.index')->with('success', 'Super Admin transferido com sucesso');
        }
        $this->alert('error', 'Algo deu errado!');
    }

    public function render()
    {
        return view('livewire.kuber.datatables-user-transfer-master');
    }
}
