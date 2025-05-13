<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(JobListingSeeder::class);
        $this->call(UserSeeder::class);

        // Seed jobs
        $this->call(JobSeeder::class);

        
        $this->call(AdminUserSeeder::class);
    }
}
