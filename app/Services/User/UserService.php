<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(array $data): User
    {
        $model = new User();
        $model->name = $data['name'] ?? null;
        $model->email = $data['email'] ?? null;
        $model->password = Hash::make($data['email'] ?? 'password');

        $model->save();

        return $model;
    }

    public function update(User $model, array $data): User
    {
        $model->name = $data['name'] ?? $model->name;
        $model->email = $data['email'] ?? $model->email;
        $model->password = isset($data['name']) ? Hash::make($data['name']) : $model->password;

        $model->save();

        return $model;
    }

    public function delete(User $model)
    {
        return $model->forceDelete();
    }
}
