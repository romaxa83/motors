<?php

namespace App\GraphQL\Mutations\User;

class CreateUser extends BaseUserMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return $this->userService->create($args);
    }
}
