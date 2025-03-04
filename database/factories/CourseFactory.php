<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'category' => $this->faker->randomElement(['programming', 'design', 'marketing', 'business']),
            'duration' => $this->faker->randomElement(['1 month', '2 months', '3 months', '4 months']),
            'status' => $this->faker->randomElement(['active', 'cancelled']),
            'teacher_id' => User::all()->random()->id,
        ];
    }
}
