<?php

namespace App\Services;

use App\Contracts\RepartidorServiceInterface;
use App\Contracts\RolesServiceInterface;
use App\Repositories\RepartidorRepository;
use App\Repositories\RolesRepository;

class RepartidorService implements RepartidorServiceInterface
{
    protected $repartidorRepository;

    public function __construct(
        RepartidorRepository $repartidorRepository,
    ) {
        $this->repartidorRepository = $repartidorRepository;
    }

    public function validateRepartidor($id)
    {
        //Verificar rol repartidor
        return $this->repartidorRepository->findUserByRol($id);
    }
}
