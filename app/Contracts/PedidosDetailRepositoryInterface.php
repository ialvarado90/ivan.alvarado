<?php

namespace App\Contracts;

use App\Models\Pedidos;

interface PedidosDetailRepositoryInterface
{
    public function store($data);

    public function getAllByPedido($pedido_id);
}
