<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->word;
        return [
            'author_id' => User::all()->random()->id,
            'category_id' => CourseCategory::all()->random()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'summary' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['publicado', 'rascunho', 'pendente']),
            'featured' => $this->faker->boolean,
            'featured_menu' => $this->faker->boolean,
        ];
    }
}
