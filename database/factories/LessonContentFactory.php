<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonContent>
 */
class LessonContentFactory extends Factory
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
            'lesson_id' => Lesson::query()->inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(4),
            'is_main' => $this->faker->boolean(),
            'is_file' => $this->faker->boolean(),
            'content_type' => $this->faker->randomElement(['url', 'youtube', 'mp4', 'doc', 'ppt', 'xls', 'pdf']),
            'content_value' => $this->faker->sentence(3),
        ];
    }
}
