<?php

namespace App\Repositories;

use App\Contracts\RepartidorRepositoryInterface;
use App\Models\User;

class RepartidorRepository implements RepartidorRepositoryInterface
{
    public function findUserByRol($id)
    {
        return User::where('rol_id', 4)->where("id", $id)->first();
    }
}
