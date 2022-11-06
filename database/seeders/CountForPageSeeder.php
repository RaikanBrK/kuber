<?php

namespace Database\Seeders;

use App\Models\countForPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        countForPage::insert([
            ['number' => 10],
            ['number' => 25],
            ['number' => 50],
            ['number' => 100],
        ]);
    }
}
