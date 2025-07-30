<?php

namespace Database\Seeders;
use App\Models\Venue;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Venue::insert([
            // FBS Venues
            ['faculty' => 'FBS', 'name' => 'Balakrishnan Hall - 1', 'code' => 'B-1'],
            ['faculty' => 'FBS', 'name' => 'Balakrishnan Hall - 2', 'code' => 'B-2'],
            ['faculty' => 'FBS', 'name' => 'Balakrishnan Hall - 3', 'code' => 'B-3'],
            ['faculty' => 'FBS', 'name' => 'Balakrishnan Hall - 4', 'code' => 'B-4'],
            ['faculty' => 'FBS', 'name' => 'Lecture Hall - 1', 'code' => 'L-1'],
            ['faculty' => 'FBS', 'name' => 'Lecture Hall - 6', 'code' => 'L-6'],
            ['faculty' => 'FBS', 'name' => 'Soosairathnam Hall - 2', 'code' => 'S-2'],
            ['faculty' => 'FBS', 'name' => 'Soosairathnam Hall - 3', 'code' => 'S-3'],
            ['faculty' => 'FBS', 'name' => 'Soosairathnam Hall - 4', 'code' => 'S-4'],
            ['faculty' => 'FBS', 'name' => 'Smart Computer Laboratory', 'code' => 'SCL'],
            ['faculty' => 'FBS', 'name' => 'Common Area', 'code' => 'Common Area'],

            // FAS Venues
            ['faculty' => 'FAS', 'name' => 'Lecture Hall - 1', 'code' => 'LH-1'],
            ['faculty' => 'FAS', 'name' => 'Lecture Hall - 2', 'code' => 'LH-2'],
            ['faculty' => 'FAS', 'name' => 'Lecture Hall - 3', 'code' => 'LH-3'],
            ['faculty' => 'FAS', 'name' => 'Lecture Hall - 4', 'code' => 'LH-4'],
            ['faculty' => 'FAS', 'name' => 'Library Lecture Hall', 'code' => 'LBH'],
            ['faculty' => 'FAS', 'name' => 'Smart Lecture Hall', 'code' => 'SL'],
            ['faculty' => 'FAS', 'name' => 'Multimedia Laboratory', 'code' => 'MML'],
            ['faculty' => 'FAS', 'name' => 'Electronic Laboratory', 'code' => 'EL'],
            ['faculty' => 'FAS', 'name' => 'Computer Laboratory - 1', 'code' => 'CL-1'],
            ['faculty' => 'FAS', 'name' => 'Computer Laboratory - 2', 'code' => 'CL-2'],
            ['faculty' => 'FAS', 'name' => 'Environmental Information System Laboratory', 'code' => 'EISL'],
            ['faculty' => 'FAS', 'name' => 'Environmental Biological Laboratory', 'code' => 'EBL'],
            ['faculty' => 'FAS', 'name' => 'Environmental Chemistry Laboratory', 'code' => 'ECL'],
            ['faculty' => 'FAS', 'name' => 'Common Area', 'code' => 'Common Area'],

            // FTS Venues
            ['faculty' => 'FTS', 'name' => 'Technological Lecture Hall - 1', 'code' => 'TLH-1'],
            ['faculty' => 'FTS', 'name' => 'Technological Lecture Hall - 2', 'code' => 'TLH-2'],
            ['faculty' => 'FTS', 'name' => 'Technological Computer Laboratory - 1', 'code' => 'TCL-1'],
            ['faculty' => 'FTS', 'name' => 'Technological Computer Laboratory - 2', 'code' => 'TCL-2'],
            ['faculty' => 'FTS', 'name' => 'Common Area', 'code' => 'Common Area'],

            //University Venues
            ['faculty' => 'University', 'name' => 'University Common Area 1', 'code' => 'University Common Area 1'],
            ['faculty' => 'University', 'name' => 'University Common Area 2', 'code' => 'University Common Area 2'],
            ['faculty' => 'University', 'name' => 'University Common Area 3', 'code' => 'University Common Area 3'],
            ['faculty' => 'University', 'name' => 'University Common Area 4', 'code' => 'University Common Area 4'],
            ['faculty' => 'University', 'name' => 'University Common Area 5', 'code' => 'University Common Area 5'],
        ]);
    }
}
