<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = \App\Models\Job::class;

    public function definition(): array
    {
        return [
            'employer_id' => 1, 
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(4),
            'location' => $this->faker->city(),
            'category' => $this->faker->randomElement(['IT', 'Finance', 'Marketing', 'HR']),
            'experience_level' => $this->faker->randomElement(['Junior', 'Mid', 'Senior']),
            'salary_min' => $this->faker->numberBetween(3000, 7000),
            'salary_max' => $this->faker->numberBetween(8000, 15000),
            'work_type' => $this->faker->randomElement(['remote', 'on-site', 'hybrid']),
            'application_deadline' => now()->addDays(rand(7, 30)),
            'logo_path' => null,
        ];
    }
}
