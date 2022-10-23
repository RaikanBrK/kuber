<?php

namespace App\Http\Livewire\kuber;

use App\Http\Livewire\kuber\datatables\ComponentDatatables;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Datatables extends ComponentDatatables
{
    public $countForPage = 10;

    protected $listeners = ['delete' => 'delete'];

    public function init() {
        $this->countForPage = Auth::user()->countForPage;
    }

    public function updatedCountForPage()
    {
        $user = Auth::user();
        $user->countForPage = $this->countForPage;
        $user->save();
    }

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
        return view('livewire.datatables');
    }
}
