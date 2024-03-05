<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = [
            ['bio' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, odio consectetur minus sed optio modi dolorum provident repellat autem perferendis nulla exercitationem, adipisci fugit veritatis dolorem! Omnis iste porro sunt.']
        ];

        About::insert($about);
        
    }
}
