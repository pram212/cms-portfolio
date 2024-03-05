<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['institution' => 'Sanbercode', 'description' => 'Laravel Web Development Course', 'start' => '2021-04-01', 'end' => '2021-05-15'],
            ['institution' => 'Eduwork', 'description' => 'Laravel & Vue Js Course', 'start' => '2021-11-01', 'end' => '2022-01-15'],
        ];

        Course::insert($courses);
        
    }
}
