<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'code' => $this->faker->unique()->word,
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente']),
        ];
    }
}
