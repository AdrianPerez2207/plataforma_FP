<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'final_score' => $this->faker->randomFloat(2, 0, 10),
            'comment' => $this->faker->text(),
            'course_id' => Course::all()->random()->id,
            'student_id' => User::all()->random()->id,
        ];
    }
}
