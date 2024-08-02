<?php

namespace App\Contracts;

interface PedidoEstadoServiceInterface
{
    public function getEstadosNext($estado_id);
    public function checkState($actual_estado_id, $new_estado_id);
}
