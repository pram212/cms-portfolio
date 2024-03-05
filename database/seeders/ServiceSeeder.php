<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [ 
            [ 'name' => 'Web Development' ], 
            [ 'name' =>'Landing Page'], 
            [ 'name' =>'Web Hosting'], 
            [ 'name' =>'Web System'], 
        ];

        Service::insert($services);
    }
}
