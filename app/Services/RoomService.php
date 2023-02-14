<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class RoomService
{
    public function createRoom(array $roomData)
    {
        $room = Room::create([
            'name' => $roomData['name'],
            'open_at' => $roomData['open_at'],
            'start_on' => $roomData['start_on'],
            'close_on' => $roomData['close_on'],
            'user_id' => $roomData['creator_id'],
            'link' => uniqid(),
            'active' => 0,
        ]);

        $this->createRoomUsers($roomData['users'], $room->id);
        $questionIds = $this->createQuestions($roomData['questions']);

        $room->questions()->attach($questionIds);

        return new RoomResource($room);
    }

    private function createRoomUsers(array $users, int $id): void
    {
        foreach ($users as $user) {
            RoomUser::insert([
                'user_email' => $user,
                'room_id' => $id,
            ]);
        }
    }

    private function createQuestions(array $questions): array
    {
        $questionIds = [];
        foreach ($questions as $question) {
            $questionIds[] = DB::table('questions')->insertGetId($question);
        }

        return $questionIds;
    }
    /**
     * @return array<string>
     */
    public function getAll(): string
    {
        return User::all()->toJson();
    }

    /**
     * @throws NotFoundException
     * @throws Exception
     */
    public function getUserById(int $userId): UserResource
    {
        $user = $this->findUser($userId);

        return new UserResource($user);
    }

    public function createUser(string $name, string $lastName, string $email): User
    {
        return User::firstOrCreate(['email' => $email], [
            'first_name' => $name,
            'last_name' => $lastName,
            'email' => $email,
        ]);
    }

    /**
     * @throws NotFoundException
     * @throws Exception
     */
    private function findUser(int $userId): User
    {
        $user = User::with('department', 'languages', 'resumes', 'resumes.skills')
            ->where('id', $userId)
            ->first();

        if (!$user) {
            throw new NotFoundException(
                sprintf('Not found user with id %d.', $userId),
            );
        }

        /** @var $user User */
        return $user;
    }
}


