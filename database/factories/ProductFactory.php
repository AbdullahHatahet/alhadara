<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => random_int(1,10000),
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'image' => $this->faker->name(),
            'price' => 100,
        ];
    }
}
