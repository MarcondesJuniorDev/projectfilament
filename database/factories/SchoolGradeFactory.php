<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolGrade>
 */
class SchoolGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => User::all()->random()->id,
            'course_id' => Course::all()->random()->id,
            'subject_id' => Subject::all()->random()->id,
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente']),
        ];
    }
}
