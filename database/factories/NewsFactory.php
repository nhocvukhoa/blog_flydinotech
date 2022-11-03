<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\UserRole;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => UserRole::ADMIN,
            'title' => $this->faker->realText($maxNbChars = 50),
            'description' => $this->faker->realText($maxNbChars = 100),
            'content' => $this->faker->realText($maxNbChars = 300),
            'image' => 'posts/minions.jpg',
            'status' => random_int(1,2),
            'viewed' => $this->faker->randomNumber,
            'slug' => $this->faker->realText($maxNbChars = 50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
