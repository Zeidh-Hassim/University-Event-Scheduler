<?php

namespace Database\Seeders;
use App\Models\Faculty;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Faculty::insert([
        ['name' => 'Faculty of Business Studies', 'code' => 'FBS'],
        ['name' => 'Faculty of Applied Science', 'code' => 'FAS'],
        ['name' => 'Faculty of Technological Studies', 'code' => 'FTS']
    ]);
}
}
