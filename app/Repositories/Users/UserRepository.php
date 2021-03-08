<?php

namespace App\Repositories\Users;

use App\Models\User\User;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    protected function query()
    {
        return User::query();
    }
}
