<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biodata = [
            'name' => 'Pramono',
            'birthday' => '1994-09-16',
            'degree' => 'A.Md',
            'title' => 'Laravel Developer',
            'summary' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate aliquid cumque nobis fuga aspernatur, distinctio, assumenda eveniet illo fugiat sit quidem laborum repellendus cum quam. Dignissimos possimus delectus consequatur tenetur!'
        ];

        Biodata::truncate();
        Biodata::create($biodata);
    }
}
