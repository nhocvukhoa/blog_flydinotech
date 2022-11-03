<?php

namespace Database\Factories;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber,
            'content' => $this->faker->realText($maxNbChars = 200),
            'status' => random_int(0,1),
            'deleted_at' => null,
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::now(),
        ];
    }
}
