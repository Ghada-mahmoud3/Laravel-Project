<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        Job::factory()->count(10)->create();
    }
}
