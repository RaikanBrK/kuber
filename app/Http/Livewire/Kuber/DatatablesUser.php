<?php

namespace App\Http\Livewire\Kuber;

use App\Http\Livewire\Kuber\datatables\ComponentDatatables;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DatatablesUser extends ComponentDatatables
{
    use LivewireAlert;
    
    public function delete($id)
    {
        $user = User::find($id);

        if ($user == null || $user->hasRole('admin-master') == true) {
            $this->alert('error', 'O super usuário não pode ser removido');
            return 'error-delete-user';
        }

        User::where('id', $id)->delete();
            
        foreach ($this->data as $key => $value) {
            if ($this->data[$key]->id == $id) {
                $this->data->forget($key);
            }
        }

        $this->updateData($this->data);
        $this->bootstrap();

        $this->alert('success', 'Usuário removido com sucesso');
        return 'success-delete-user';
    }

    public function render()
    {
        return view('livewire.kuber.datatables-user');
    }
}
