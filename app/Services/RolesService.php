<?php

namespace App\Services;

use App\Contracts\RolesServiceInterface;
use App\Repositories\RolesRepository;

class RolesService implements RolesServiceInterface
{
    protected $rolesRepository;

    public function __construct(
        RolesRepository $rolesRepository,
    ) {
        $this->rolesRepository = $rolesRepository;
    }

    public function getRoles()
    {
        //Obtener lista de roles
        return $this->rolesRepository->getAll();
    }
}
