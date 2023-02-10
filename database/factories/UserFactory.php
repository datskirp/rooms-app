<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => sprintf('factory_email+%s@innowise-group.com', fake()->randomNumber(5)),
            'remember_token' => Str::random(10),
        ];
    }
}
