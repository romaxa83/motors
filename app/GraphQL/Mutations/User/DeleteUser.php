<?php

namespace App\GraphQL\Mutations\User;

class DeleteUser extends BaseUserMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = $this->userRepository->getByID($args['id']);

        return [
            'status' => $this->userService->delete($user),
            'message' => 'Model deleted',
        ];
    }
}

