<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Exception;

class UserController extends ApiController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function getAll(): JsonResponse
    {
        try {
            $users = $this->userService->getAll();
            return $this->successResponse($users);
        } catch (Exception) {
            return $this->serverErrorResponse();
        }
    }
}
