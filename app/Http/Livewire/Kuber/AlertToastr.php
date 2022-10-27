<?php

namespace App\Http\Livewire\Kuber;

use Livewire\Component;

class AlertToastr extends Component
{
    public function render()
    {
        $errors = session()->get('errors');
        if ($errors) {
            foreach(array_reverse($errors->all()) as $error) {
                toastr()->error($error);
            }
        }

        return view('livewire.kuber.alert-toastr');
    }
}
