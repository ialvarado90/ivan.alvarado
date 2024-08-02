<?php

namespace App\Contracts;

use App\Models\Pedidos;

interface PedidoEstadoRepositoryInterface
{
    public function getAllNext($estado_id);
    public function find($estado_id);
    public function getAll();
}
