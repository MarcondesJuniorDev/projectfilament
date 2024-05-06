<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Award>
 */
class AwardFactory extends Factory
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
            'author_id' => User::query()->inRandomOrder()->first()->id ?? null,
            'image' => $this->faker->imageUrl(),
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => $this->faker->randomElement(['rascunho', 'publicado', 'pendente']),
            'featured' => $this->faker->boolean(5),
            'summary' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraph(4),
        ];
    }
}
