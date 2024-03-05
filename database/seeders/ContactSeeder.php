<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            'phone' => '+62 85880541729',
            'email' => 'pramono6236@gmail.com',
            'address' => 'Cihampelas, West Bandung',
        ];

        Contact::insert($contacts);
        
    }
}
