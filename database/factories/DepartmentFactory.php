<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->company;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'responsible_id' => User::factory(),
            'author_id' => User::factory(),
            'parent_id' => $this->faker->randomElement([null, Department::factory()]),
            'order' => $this->faker->randomNumber(),
            'summary' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->boolean(),
            'bg_color' => $this->faker->hexColor(),
        ];
    }
}
