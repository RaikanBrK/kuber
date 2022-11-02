<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function add($request): User;
    public function update($id, $request): User;
    public function delete($id);
}
