<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(100),
            'content' => $this->faker->text(200),
            'viewed' => $this->faker->randomNumber,
            'status' => PostStatus::getRandomValue(),
            'image' => 'posts/minions.jpg',
            'deleted_at' => null,
            'published_at' => Carbon::yesterday(),
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::today(),
        ];
    }
}
