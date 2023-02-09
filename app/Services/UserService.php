<?php

declare(strict_types=1);

namespace App\Services;

//use App\Exceptions\NotFoundException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        $users = User::with('department', 'languages', 'resumes', 'resumes.skills')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('resumes')
                    ->whereColumn('resumes.user_id', 'users.id');
            })
            ->orderBy('last_name')
            ->orderBy('name')
            ->orderBy('id')
            ->get();

        return UserResource::collection($users)->resolve();
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
        return User::updateOrCreate(['email' => $email], [
            'name' => $name,
            'last_name' => $lastName,
            'email' => $email,
            'password' => bcrypt(Str::random(40)),
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
