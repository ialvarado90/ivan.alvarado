<?php

namespace App\Contracts;

use App\Models\Pedidos;

interface PedidosRepositoryInterface
{
    public function store($data);

    public function update(Pedidos $pedidos, $data);

    public function edit($id);

    public function getAll();

    public function getAllByNropedido($nro_pedido);
}
