<?php

namespace App\Services;

use App\Contracts\PedidosDetailRepositoryInterface;
use App\Contracts\PedidosRepositoryInterface;
use App\Contracts\PedidosServiceInterface;
use App\Models\Pedidos;

class PedidosService implements PedidosServiceInterface
{
    protected $pedidosRepository;
    protected $pedidosDetailRepository;

    public function __construct(
        PedidosRepositoryInterface $pedidosRepository,
        PedidosDetailRepositoryInterface $pedidosDetailRepository,
    ) {
        $this->pedidosRepository = $pedidosRepository;
        $this->pedidosDetailRepository = $pedidosDetailRepository;
    }

    public function store($data)
    {
        //Obtener sesion usuario(vendedor) que solicita
        $user = $data["user"];
        $arr_data = [
            "nro_pedido" => $data["nro_pedido"],
            "vendedor_id" => $user->id,
        ];
        return $this->pedidosRepository->store($arr_data);
    }

    public function changeState(Pedidos $pedidos, $data)
    {
        //Actualizar fecha / estado pedido
        $estado_id = $data["estado_id"];
        switch ($estado_id) {
            case 1: //Pedido por atender
                $arr_data = [
                    "estado_id" => $estado_id,
                    "pedido_at" => date("Y-m-d H:i:s"),
                ];
                break;
            case 2: //Pedido en proceso
                $arr_data = [
                    "estado_id" => $estado_id,
                    "recepcion_at" => date("Y-m-d H:i:s"),
                ];
                break;
            case 3: //Pedido en delivery
                $arr_data = [
                    "estado_id" => $estado_id,
                    "repartidor_id" => $data["repartidor_id"],
                    "despacho_at" => date("Y-m-d H:i:s"),
                ];
                break;
            case 4: //Pedido recibido
                $arr_data = [
                    "estado_id" => $estado_id,
                    "entrega_at" => date("Y-m-d H:i:s"),
                ];
                break;
            default:
                # code...
                break;
        }

        return $this->pedidosRepository->update($pedidos, $arr_data);
    }

    public function edit($id)
    {
        return $this->pedidosRepository->edit($id);
    }

    public function getDatatable($request)
    {
        $data = array();
        if (isset($request["nro_pedido"]) && $request["nro_pedido"] != "") {
            $data = $this->pedidosRepository->getAllByNropedido($request["nro_pedido"]);
        } else {
            $data = $this->pedidosRepository->getAll();
        }
        foreach ($data as $key => $value) {
            //Obtener detalle de pedido
            $detail = $this->pedidosDetailRepository->getAllByPedido($value->id);
            $data[$key]->detail = $detail;
        }
        return $data;
    }
}
