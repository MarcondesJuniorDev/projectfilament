<?php

namespace Database\Factories;

use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(2);
        return [
            'author_id' => User::query()->inRandomOrder()->first()->id,
            'category_id' => EventCategory::query()->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente']),
            'featured' => $this->faker->boolean(10),
            'content' => $this->faker->paragraph(2),
            'summary' => $this->faker->sentence(4),
            'tags' => $this->faker->words(5),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'published_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}
