<?php

namespace App\Repositories\Users;

use App\Models\User\Role;
use App\Repositories\AbstractRepository;

class RoleRepository extends AbstractRepository
{
    protected function query()
    {
        return Role::query();
    }

    /**
     * @param string $alias
     * @param array $relation
     */
    public function getByAlias(string $alias, array $relation = [])
    {
        return $this->query()
            ->with($relation)
            ->where('alias', $alias)
            ->first();
    }
}
