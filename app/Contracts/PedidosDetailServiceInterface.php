<?php

namespace App\Contracts;

interface PedidosDetailServiceInterface
{
    public function store($pedido_id, $data);
}
