<?php

namespace Database\Factories;

use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(3, true);
        return [
            'author_id' => User::query()->inRandomOrder()->first()->id,
            'category_id' => NewsCategory::query()->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'summary' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente']),
            'featured' => $this->faker->boolean,
            'tags' => $this->faker->words(3, true),
            'published_at' => $this->faker->dateTime,
        ];
    }
}
