<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;

class JobSeeder extends Seeder
{
    public function run()
    {
        // Fetch employer IDs from the users table
        $employerIds = User::where('role', 'employer')->pluck('id');

        // Ensure there is at least one employer
        if ($employerIds->isEmpty()) {
            throw new \Exception("No employers found in the database. Please seed users with the 'employer' role.");
        }

        // Insert fake jobs
        $jobs = [
            [
                'title' => 'Software Engineer',
                'description' => 'Develop and maintain web applications.',
                'location' => 'New York',
                'category' => 'IT',
                'experience_level' => 'Senior',
                'salary_min' => 70000,
                'salary_max' => 120000,
                'work_type' => 'Full-Time',
                'application_deadline' => now()->addDays(30),
                'employer_id' => $employerIds->random(),
                'logo_path' => 'logos/software_engineer.jpg',
                'is_approved' => true,
            ],
            [
                'title' => 'Marketing Manager',
                'description' => 'Plan and execute marketing campaigns.',
                'location' => 'Los Angeles',
                'category' => 'Marketing',
                'experience_level' => 'Mid',
                'salary_min' => 45000,
                'salary_max' => 80000,
                'work_type' => 'Remote',
                'application_deadline' => now()->addDays(15),
                'employer_id' => $employerIds->random(),
                'logo_path' => 'logos/marketing_manager.jpg',
                'is_approved' => false,
            ],
            [
                'title' => 'Nurse',
                'description' => 'Provide medical care to patients.',
                'location' => 'Chicago',
                'category' => 'Healthcare',
                'experience_level' => 'Entry',
                'salary_min' => 30000,
                'salary_max' => 50000,
                'work_type' => 'Part-Time',
                'application_deadline' => now()->addDays(20),
                'employer_id' => $employerIds->random(),
                'logo_path' => 'logos/nurse.jpg',
                'is_approved' => true,
            ],
            [
                'title' => 'Teacher',
                'description' => 'Teach students in a high school setting.',
                'location' => 'Houston',
                'category' => 'Education',
                'experience_level' => 'Mid',
                'salary_min' => 35000,
                'salary_max' => 60000,
                'work_type' => 'Full-Time',
                'application_deadline' => now()->addDays(40),
                'employer_id' => $employerIds->random(),
                'logo_path' => 'logos/teacher.jpg',
                'is_approved' => true,
            ],
        ];

        // Insert the jobs into the database
        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}