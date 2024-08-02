<?php

namespace App\Repositories;

use App\Contracts\PedidoEstadoRepositoryInterface;
use App\Models\PedidoEstado;

class PedidoEstadoRepository implements PedidoEstadoRepositoryInterface
{

    public function getAllNext($estado)
    {
        return PedidoEstado::where("position", ">", $estado->position)->orderBy("position", "ASC")->get(["id", "nombre"]);
    }

    public function find($estado_id)
    {
        return PedidoEstado::find($estado_id);
    }

    public function getAll()
    {
        return PedidoEstado::orderBy("position", "ASC")->get(["id", "nombre"]);
    }
}
