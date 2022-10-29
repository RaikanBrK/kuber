<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository
{
    public function add($request): User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->givePermissionTo('user');
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
}
