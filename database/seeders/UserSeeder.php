<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Carlos Alexandre',
            'email' => 'raikanbr4@gmail.com',
            'password' => '$2y$10$99CqtuizT4ss/uwkUbWP0eNG11sERPMYgTlImp6l/q2eIed4XqfVG',
        ]);
    }
}
