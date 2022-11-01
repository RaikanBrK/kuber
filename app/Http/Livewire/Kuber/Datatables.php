<?php

namespace App\Http\Livewire\Kuber;

use App\Http\Livewire\Kuber\datatables\ComponentDatatables;
use App\Models\User;

class Datatables extends ComponentDatatables
{
    protected $listeners = ['delete' => 'delete'];

    public function delete($id)
    {
        User::where('id', $id)->delete();

        foreach ($this->data as $key => $value) {
            if ($this->data[$key]->id == $id) {
                $this->data->forget($key);
            }
        }

        $this->updateData($this->data);
        $this->bootstrap();
    }

    public function render()
    {
        return view('livewire.kuber.datatables');
    }
}
