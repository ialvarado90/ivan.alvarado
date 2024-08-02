<?php

namespace App\Contracts;

use App\Models\Productos;

interface ProductosServiceInterface
{
    public function store($data);
    public function update(Productos $productos, $data);
    public function edit($id);
    public function getProductoList($data);
}
