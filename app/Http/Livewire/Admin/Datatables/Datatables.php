<?php

namespace App\Http\Livewire\Kuber;

use App\Http\Livewire\Admin\Datatables\ComponentDatatables;
use App\Repositories\User\EloquentUserRepository;

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
