<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository
{
    public function add($request): User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('admin');
    }

    public function update($id, $request): User
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->checkBoxChangePassword) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);

        $this->removeAllRoleUser($user);
        
        $user->delete();
    }

    protected function removeAllRoleUser($user)
    {
        Role::all()->each(function($item) use($user) {
            $user->removeRole($item->name);
        });
    }
}
