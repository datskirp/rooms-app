<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        $close_on = $this->faker->date('Y-m-d', '+1 year');
        $start_on = $this->faker->date('Y-m-d', $close_on);
        return [
            'name' => $this->faker->text(32),
            'open_at' => $this->faker->time(),
            'start_on' => $start_on,
            'close_on' => $close_on,
            'user_id' => User::factory(),
        ];
    }
}
