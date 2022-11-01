<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Carlos Alexandre',
            'email' => 'raikanbr4@gmail.com',
            'password' => '$2y$10$99CqtuizT4ss/uwkUbWP0eNG11sERPMYgTlImp6l/q2eIed4XqfVG',
        ])->assignRole('admin-master', 'admin');
    }
}
