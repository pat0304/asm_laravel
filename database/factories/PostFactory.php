<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Post::class;
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'image' => fake()->imageUrl(),
            'description' => fake()->sentence(),
            'content' => json_encode([fake()->paragraph(), fake()->imageUrl()]),
            'view' => rand(1, 100),
            'category_id' => rand(1, 3),
        ];
    }
}