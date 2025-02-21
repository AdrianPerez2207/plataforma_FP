<?php

namespace Database\Seeders;

use App\Models\Registration;
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
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(RegistrationSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(Course_MaterialSeeder::class);
    }
}
