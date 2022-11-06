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
            'gender_id' => $request->gender,
        ])->assignRole('admin');
    }

    public function update($id, $request, $imagePath = false): User
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender_id = $request->gender;
        
        if($user->desc() != $request->desc) {
            $user->description = $request->desc;
        }

        if ($request->checkBoxChangePassword) {
            $user->password = Hash::make($request->password);
        }

        if ($imagePath) {
            $user->image = $imagePath;
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
