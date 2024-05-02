<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\SchoolGrade;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'author_id' => User::inRandomOrder()->first()->id,
            'school_grade_id' => SchoolGrade::inRandomOrder()->first()->id,
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'school_year_id' => SchoolYear::inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'code' => $this->faker->unique()->randomNumber(3),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente', 'cancelado']),
            'tags' => $this->faker->words(3, true),
            'lesson_date' => $this->faker->date(),
        ];
    }
}
