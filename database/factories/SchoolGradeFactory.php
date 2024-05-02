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
            'author_id' => User::query()->inRandomOrder()->first()->id,
            'course_id' => Course::query()->inRandomOrder()->first()->id,
            'subject_id' => Subject::query()->inRandomOrder()->first()->id,
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente']),
        ];
    }
}
