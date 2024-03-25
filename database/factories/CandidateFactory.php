<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition()
    {
        $options = ['PHP Developer', 'JAVA Developer', 'PYTHON Developer', 'ERP Support', 'Sales', 'Technician'];
        $count = count($options);
        $jobAppliedFor = $this->faker->randomElements($options, rand(1,$count));
        return [
            'lastName' => $this->faker->lastName,
            'firstName' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->numerify('##########'),
            'degree' => $this->faker->randomElement(['BSc', 'MSc', 'PhD']),
            'resume' => 'path/to/resume.pdf', // Path to a sample resume file
            'jobAppliedFor' => implode(',', $jobAppliedFor),
        ];
    }
}
