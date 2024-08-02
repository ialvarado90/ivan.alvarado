<?php

namespace App\Repositories;

use App\Contracts\PedidosRepositoryInterface;
use App\Models\Pedidos;

class PedidosRepository implements PedidosRepositoryInterface
{
    public function store($data)
    {
        return Pedidos::create($data);
    }

    public function update(Pedidos $pedidos, $data)
    {
        return $pedidos->update($data);
    }

    public function edit($id)
    {
        return Pedidos::find($id);
    }

    public function getAll()
    {
        return Pedidos::where("status", 1)->get();
    }

    public function getAllByNropedido($nro_pedido)
    {
        return Pedidos::where("nro_pedido", $nro_pedido)->where("status", 1)->get();
    }
}
