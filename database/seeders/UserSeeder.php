<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Pramono',
            'email' => 'pramono6236@gmail.com',
            'email_verified_at' => now(),
            'password' => 'pramono1994%',
            'remember_token' => Str::random(10),
        ];

        User::truncate();

        User::create($user);
    }
}
