<?php

namespace App\Services;

use App\Contracts\PedidosDetailRepositoryInterface;
use App\Contracts\PedidosDetailServiceInterface;
use App\Contracts\PedidosServiceInterface;
use App\Models\Pedidos;

class PedidosDetailService implements PedidosDetailServiceInterface
{
    protected $pedidosDetailRepository;

    public function __construct(
        PedidosDetailRepositoryInterface $pedidosDetailRepository,
    ) {
        $this->pedidosDetailRepository = $pedidosDetailRepository;
    }

    public function store($pedido_id, $data)
    {
        //Recorrer productos seleccionados
        $producto_id = $data["producto_id"];
        $cantidad = $data["cantidad"];
        $arr_data = array();
        foreach ($producto_id as $key => $value) {
            $arr_data[] = [
                "producto_id" => $value,
                "pedido_id" => $pedido_id,
                "cantidad" => $cantidad[$key]
            ];
        }
        return $this->pedidosDetailRepository->store($arr_data);
    }

    public function update(Pedidos $pedidos, $data)
    {
        $arr_data = [
            "nombre" => $data["nombre"],
            "sku" => $data["sku"],
            "tipo" => $data["tipo"],
            "tags" => $data["tags"],
            "price" => $data["price"],
            "unidad" => $data["unidad"],
        ];
        return $this->pedidosDetailRepository->update($pedidos, $arr_data);
    }

    public function edit($id)
    {
        return $this->pedidosDetailRepository->edit($id);
    }
}
