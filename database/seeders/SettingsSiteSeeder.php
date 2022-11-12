<?php

namespace Database\Seeders;

use App\Models\SettingsSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsSite::create([
            'id' => 1,
        ]);
    }
}
