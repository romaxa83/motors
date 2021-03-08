<?php

namespace App\GraphQL\Mutations\User;

use App\Services\User\UserService;

class UpdateUser extends BaseUserMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = $this->userRepository->getByID($args['id']);
        return $this->userService->update($user, $args);
    }
}
