<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'email' => sprintf('factory_email+%s@innowise-group.com', $this->faker->randomNumber(5)),
            'remember_token' => Str::random(10),
        ];
    }
}
