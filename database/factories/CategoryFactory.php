<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(30),
            'description' => $this->faker->text(200),
            'status' => $this->faker->numberBetween(0, 1),
            'order_by' => null,
            'parent_id' => null,
            // 'deleted_at' => Carbon::tomorrow(),
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::today(),
        ];
    }
}
