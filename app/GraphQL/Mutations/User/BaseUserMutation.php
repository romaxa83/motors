<?php

namespace App\GraphQL\Mutations\User;

use App\Repositories\Users\UserRepository;
use App\Services\User\UserService;

class BaseUserMutation
{
    protected UserService $userService;
    protected UserRepository $userRepository;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository
    )
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }
}
