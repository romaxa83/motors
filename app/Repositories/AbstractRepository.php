<?php

namespace App\Repositories;

abstract class AbstractRepository
{
    public function __construct()
    {}

    abstract protected function query();

    public function getByID($id, array $relation = [], $withActive = false)
    {
        $query = $this->query()
            ->with($relation)
            ->where('id', $id);

        if($withActive){
            $query->active();
        }

        return $query->first();
    }
}

