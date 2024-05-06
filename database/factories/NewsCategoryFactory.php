<?php

namespace Database\Factories;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsCategory>
 */
class NewsCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word;
        return [
            'parent_id' => NewsCategory::query()->inRandomOrder()->first()?->id ?? null,
            'order' => $this->faker->numberBetween(11, 99),
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
