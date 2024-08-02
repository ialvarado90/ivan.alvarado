<?php

namespace App\Repositories;

use App\Contracts\ProductosRepositoryInterface;
use App\Models\Productos;

class ProductosRepository implements ProductosRepositoryInterface
{
    public function store($data)
    {
        return Productos::create($data);
    }

    public function update(Productos $productos, $data)
    {
        return $productos->update($data);
    }

    public function edit($id)
    {
        return Productos::find($id);
    }

    public function getAll()
    {
        return Productos::where("status", 1)->get();
    }

    public function getAllByFilter($search)
    {
        $where = " (nombre LIKE '%$search%' OR sku LIKE '%$search%') ";

        return Productos::whereRaw($where)->where("status", 1)->get();
    }
}
