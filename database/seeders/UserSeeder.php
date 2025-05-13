<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create an employer user
        User::create([
            'name' => 'Employer User',
            'email' => 'employer@example.com',
            'password' => bcrypt('password'),
            'role' => 'employer',
        ]);

        // Create a candidate user
        User::create([
            'name' => 'Candidate User',
            'email' => 'candidate@example.com',
            'password' => bcrypt('password'),
            'role' => 'candidate',
        ]);
    }
}