<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomUserFactory extends Factory
{
    public function definition()
    {
        return [
            'user_email' => User::inRandomOrder()->value('email'),
            'room_id' => Room::factory(),
        ];
    }
}
