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
        Degree::create(['degreeTitle' => 'High School']);
        Degree::create(['degreeTitle' => 'BSc']);
        Degree::create(['degreeTitle' => 'MSc']);

        Candidate::factory()->count(100)->create();
    }
}
