<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [ 
            ['name' => 'Laravel', 'presentage' => '80'],
            ['name' => 'PHP', 'presentage' => '80'],
            ['name' => 'HTML', 'presentage' => '80'],
            ['name' => 'CSS', 'presentage' => '80'],
            ['name' => 'Javascript', 'presentage' => '80'],
            ['name' => 'Mysql', 'presentage' => '80'],
            ['name' => 'Node js', 'presentage' => '80'],
            ['name' => 'Express Js', 'presentage' => '80'],
            ['name' => 'Vue Js', 'presentage' => '80'],
            ['name' => 'Tailwind CSS', 'presentage' => '80'],
            ['name' => 'jQuery', 'presentage' => '80'],
            ['name' => 'Bootstrap', 'presentage' => '80']
        ];

        Skill::insert($skills);
    }
}
