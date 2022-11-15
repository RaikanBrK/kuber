<?php

namespace App\Http\Livewire\Kuber;

use App\Models\User;
use App\Repositories\EloquentUserRepository;
use App\Http\Livewire\Admin\Datatables\ComponentDatatables;

class Datatables extends ComponentDatatables
{
    protected $listeners = ['delete' => 'delete'];

    public function delete($id)
    {
        $repository = new EloquentUserRepository();
        $repository->delete($id);

        $this->resetDateRemoveItem($id);
    }

    public function render()
    {
        return view('livewire.kuber.datatables');
    }
}
