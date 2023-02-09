<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use App\Services\UserService;
use Laravel\Socialite\Two\User as SocialiteUser;

class AuthService
{
    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    final public function getUser(SocialiteUser $socialiteUser): User
    {
        $firstname = $socialiteUser->user['given_name'];
        $lastName = $socialiteUser->user['family_name'];
        $email = $socialiteUser->getEmail();

        $user = $this->userService->createUser($firstname, $lastName, $email);


        return $user;
    }
}
