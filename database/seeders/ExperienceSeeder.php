<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [ "start" => '2020-01-01', "end" => '2021-10-20', "company" => 'PT DesaTech Nusantara', "position" => 'Technical Writer' ],
            [ "start" => '2022-02-14', "end" => '2022-08-17', "company" => 'PT Mandala Dwipantara', "position" => 'Software Engineer' ],
            [ "start" => '2022-09-11', "end" => NULL , "company" => 'PT Melkhior Teknologi', "position" => 'Fullstack Developer' ],
        ];

        Experience::insert($data);
    }
}
