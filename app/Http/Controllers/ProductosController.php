<?php

namespace App\Http\Controllers;

use App\Contracts\ProductosServiceInterface;
use App\Http\Requests\ProductosStoreRequest;
use App\Http\Requests\ProductosUpdateRequest;
use App\Services\ProductosService;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    protected $productosService;
    protected $rolesService;

    public function __construct(ProductosServiceInterface $productosService,)
    {
        $this->productosService = $productosService;
    }

    public function store(ProductosStoreRequest $request)
    {
        try {
            // Lógica para crear el nuevo registro producto
            $user = $this->productosService->store($request->validated());
            return response()->json(['message' => 'Se registró producto.'], 201);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error',
                'message' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }

    public function edit($id)
    {
        //Buscar producto
        $producto = $this->productosService->edit($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        return response()->json(["producto" => $producto]);
    }

    public function update(ProductosUpdateRequest $request, $id)
    {
        try {
            //Buscar producto
            $producto = $this->productosService->edit($id);
            if (!$producto) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            // Lógica para actualizar producto
            $producto = $this->productosService->update($producto, $request->validated());
            return response()->json([
                'message' => 'Se actualizó producto.'
            ], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error',
                'message' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }    

    public function datatable(Request $request)
    {
        //Obtener lista de productos y mostrarlo en datatable
        $users = $this->productosService->getProductoList($request);
        return response()->json($users);
    }
}
