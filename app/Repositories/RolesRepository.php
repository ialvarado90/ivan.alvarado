<?php

namespace App\Repositories;

use App\Contracts\RolesRepositoryInterface;
use App\Models\Roles;

class RolesRepository implements RolesRepositoryInterface
{
    public function getAll()
    {
        return Roles::where('status', 1)->get(["id", "nombre"]);
    }
}
