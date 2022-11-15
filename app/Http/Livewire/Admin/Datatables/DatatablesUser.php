<?php

namespace App\Http\Livewire\Admin\Datatables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\Admin\Datatables\ComponentDatatables;
use App\Repositories\User\EloquentUserRepository;

class DatatablesUser extends ComponentDatatables
{
    use LivewireAlert;

    protected $listeners = ['delete' => 'delete'];
    
    public function delete($id)
    {
        $user = User::find($id);

        if ($user == null) {
            return false;
        }

        if ($user->hasRole('admin-master') == true) {
            $this->alert('error', 'O super admin não pode ser removido');
            return 'error-delete-user';
        }

        $repository = new EloquentUserRepository();
        $repository->delete($id);
        
        if ($id == auth()->user()->id) {
            $this->logout();
        }
        
        $this->resetDateRemoveItem($id);

        $this->alert('success', 'Usuário removido com sucesso');
        return 'success-delete-user';
    }

    public function logout() 
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.admin.datatables.datatables-user');
    }
}
