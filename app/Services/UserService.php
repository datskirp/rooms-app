<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserService
{
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
