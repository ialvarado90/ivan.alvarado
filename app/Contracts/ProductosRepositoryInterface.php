<?php

namespace App\Contracts;

use App\Models\Productos;

interface ProductosRepositoryInterface
{
    public function store($data);

    public function update(Productos $productos, $data);

    public function edit($id);

    public function getAll();

    public function getAllByFilter($search);
}
