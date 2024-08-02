<?php

namespace App\Repositories;

use App\Contracts\PedidosDetailRepositoryInterface;
use App\Models\Pedidos;
use App\Models\PedidosDetail;

class PedidosDetailRepository implements PedidosDetailRepositoryInterface
{
    public function store($data)
    {
        return PedidosDetail::insert($data);
    }

    public function getAllByPedido($pedido_id)
    {
        return PedidosDetail::where("pedido_id", $pedido_id)
            ->join("producto", "pedidos_detail.producto_id", "producto.id")
            ->get(["pedidos_detail.*","producto.nombre AS producto_nombre"]);
    }
}
