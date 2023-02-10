<?php

namespace Database\Seeders;

use App\Models\RoomUser;
use App\Models\User;
use Database\Factories\RoomUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
    }
}
