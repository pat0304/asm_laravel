<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\OrderDetail::class;
    public function definition(): array
    {
        return [
            'product_id' => rand(1, 10),
            'order_id' => rand(1, 5),
            'amount' => rand(1, 3),
        ];
    }
}