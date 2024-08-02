<?php

namespace App\Services;

use App\Contracts\ProductosRepositoryInterface;
use App\Contracts\ProductosServiceInterface;
use App\Models\Productos;

class ProductosService implements ProductosServiceInterface
{
    protected $productosRepository;

    public function __construct(
        ProductosRepositoryInterface $productosRepository,
    ) {
        $this->productosRepository = $productosRepository;
    }

    public function store($data)
    {
        $arr_data = [
            "nombre" => $data["nombre"],
            "sku" => $data["sku"],
            "tipo" => $data["tipo"],
            "tags" => $data["tags"],
            "price" => $data["price"],
            "unidad" => $data["unidad"],
        ];
        return $this->productosRepository->store($arr_data);
    }

    public function update(Productos $productos, $data)
    {
        $arr_data = [
            "nombre" => $data["nombre"],
            "sku" => $data["sku"],
            "tipo" => $data["tipo"],
            "tags" => $data["tags"],
            "price" => $data["price"],
            "unidad" => $data["unidad"],
        ];
        return $this->productosRepository->update($productos, $arr_data);
    }

    public function edit($id)
    {
        return $this->productosRepository->edit($id);
    }

    public function getDatatable($data)
    {
        if (isset($data["search"]) && $data["search"] != "") {
            return $this->productosRepository->getAllByFilter($data["search"]);
        } else {
            return $this->productosRepository->getAll();
        }
    }

    public function getList()
    {
        return $this->productosRepository->getAll();
    }
}
