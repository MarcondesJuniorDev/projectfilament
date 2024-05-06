<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\BannerCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
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
            'category_id' => BannerCategory::query()->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => $this->faker->imageUrl(),
            'url' => $this->faker->url,
            'status' => $this->faker->randomElement(['rascunho', 'publicado', 'pendente']),
        ];
    }
}
