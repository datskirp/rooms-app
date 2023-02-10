<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(2)->
            has(Room::factory()->count(1), 'ownRooms')
            ->create();
    }
}
