<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Degree;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Degree::insert([
            ['degreeTitle' => 'High School'],
            ['degreeTitle' => 'BSc'],
            ['degreeTitle' => 'MSc'],
        ]);

        Candidate::factory()->count(100)->create();
    }
}
