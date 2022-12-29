<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Stringable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'month_id' => fake()->month(),
        ];
    }
}
