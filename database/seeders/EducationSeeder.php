<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            ['institution' => 'SMAN 1 Cililin', 'title' => 'Senior High School', 'start' => '2010', 'end' => '2012'],
            ['institution' => 'STEbank Islam Mr. Sjarfuddin Prawiranegara', 'title' => 'Diploma 3 In Islamic Banking', 'start' => '2014', 'end' => '2017'],
        ];

        Education::insert($educations);

    }
}
