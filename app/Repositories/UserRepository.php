<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->where("status", 1)->first();
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function update(User $user, $data)
    {
        return $user->update($data);
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function getAll()
    {
        return User::where("status", 1)->get();
    }

    public function getAllByRol($rol_id)
    {
        return User::where("rol_id", $rol_id)->where("status", 1)->get();
    }
}
