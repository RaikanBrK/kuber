<?php

namespace App\Http\Livewire\kuber;

use App\Http\Livewire\kuber\datatables\ComponentDatatables;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Datatables extends ComponentDatatables
{
    public $countForPage = 10;

    public function init() {
        $this->countForPage = Auth::user()->countForPage;
    }

    public function updatedCountForPage()
    {
        $user = Auth::user();
        $user->countForPage = $this->countForPage;
        $user->save();
    }

    public function render()
    {
        return view('livewire.datatables');
    }
}
