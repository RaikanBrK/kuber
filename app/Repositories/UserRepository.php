<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function add($request): User;
    public function update($id, $request, $imagePath = false): User;
    public function delete($id);
    public function updateCountForPage($newCountForPage);
}
