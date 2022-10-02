<?php

namespace App\Http\Livewire\kuber;

use App\Http\Livewire\kuber\datatables\ComponentDatatables;

class Datatables extends ComponentDatatables
{
    public function render()
    {
        return view('livewire.datatables');
    }
}
