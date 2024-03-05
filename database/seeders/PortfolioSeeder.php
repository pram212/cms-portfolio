<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolio = [
            [
                'code' => '01',
                'project_title' => 'Insurance Management System',
                'start' => '2021-02-14',
                'end' => '2022-06-15',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro eaque perferendis mollitia atque beatae saepe est perspiciatis non, laboriosam expedita libero et magnam modi suscipit provident dolor temporibus cum culpa.',
                'technologies' => json_encode([
                    'laravel', 'php', 'mysql'
                ]),
                'modules' => json_encode([
                    'Summary Of Comision management',
                    'Polis management',
                    'Membership management'
                ]),
                'images' => json_encode([
                    '/img/port-alamin1.png',
                    '/img/port-alamin2.png',
                    '/img/port-alamin3.png'
                ]),
                'demo' => json_encode([
                    'url' => '-',
                    'info' => 'username: admin, password: edshfkdsf'
                ])
            ]
        ];

        Portfolio::insert($portfolio);
    }
}
