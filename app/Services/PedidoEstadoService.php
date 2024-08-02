<?php

namespace App\Services;

use App\Contracts\PedidoEstadoRepositoryInterface;
use App\Contracts\PedidoEstadoServiceInterface;

class PedidoEstadoService implements PedidoEstadoServiceInterface
{
    protected $pedidoEstadoRepository;

    public function __construct(
        PedidoEstadoRepositoryInterface $pedidoEstadoRepository,
    ) {
        $this->pedidoEstadoRepository = $pedidoEstadoRepository;
    }

    public function getEstadosNext($estado_id)
    {
        //Verificar estado pedido actual
        if (is_null($estado_id) || $estado_id == 0) {
            //Si aun no tiene estado
            //Obtener lista estados siguientes disponibles
            return  $this->pedidoEstadoRepository->getAll();
        } else {
            //Si ya tiene estado
            $estado = $this->pedidoEstadoRepository->find($estado_id);
            //Obtener lista estados siguientes disponibles
            return  $this->pedidoEstadoRepository->getAllNext($estado);
        }
    }

    //Comparar nuevo estado / estado actual, no permitir retroceder estado
    public function checkState($actual_estado_id, $new_estado_id)
    {
        $actual_estado = $this->pedidoEstadoRepository->find($actual_estado_id);
        $new_estado = $this->pedidoEstadoRepository->find($new_estado_id);
        if ($new_estado->position < $actual_estado->position) {
            return false;
        } else {
            return true;
        }
    }
}
