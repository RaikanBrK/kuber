<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('123456789'),
            'gender_id' => 1,
        ])->assignRole('admin-master', 'admin');
    }
}
