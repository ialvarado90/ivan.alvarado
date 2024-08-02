<?php

namespace App\Contracts;

use App\Models\Pedidos;

interface PedidosServiceInterface
{
    public function store($data);
    public function changeState(Pedidos $pedidos, $data);
    public function edit($id);
    public function getDatatable($data);
}
