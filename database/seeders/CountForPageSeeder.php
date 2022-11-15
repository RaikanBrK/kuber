<?php

namespace Database\Seeders;

use App\Models\CountForPage;
use Illuminate\Database\Seeder;

class CountForPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CountForPage::insert([
            ['number' => 10],
            ['number' => 25],
            ['number' => 50],
            ['number' => 100],
        ]);
    }
}
