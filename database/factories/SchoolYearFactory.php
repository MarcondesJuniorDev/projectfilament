<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolYear>
 */
class SchoolYearFactory extends Factory
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
            'year' => $this->faker->year,
            'is_current' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}
