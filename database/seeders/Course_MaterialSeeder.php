<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Course_Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Course_MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course_Material::factory(20)->create();
    }
}
