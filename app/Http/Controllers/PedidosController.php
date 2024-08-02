<?php

namespace App\Http\Controllers;

use App\Contracts\PedidoEstadoServiceInterface;
use App\Contracts\PedidosDetailServiceInterface;
use App\Contracts\PedidosServiceInterface;
use App\Contracts\RepartidorServiceInterface;
use App\Http\Requests\PedidoChangeStateRequest;
use App\Http\Requests\PedidosStoreRequest;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    protected $pedidosService;
    protected $pedidosDetailService;
    protected $pedidoEstadoService;
    protected $repartidorService;

    public function __construct(
        PedidosServiceInterface $pedidosService,
        PedidosDetailServiceInterface $pedidosDetailService,
        PedidoEstadoServiceInterface $pedidoEstadoService,
        RepartidorServiceInterface $repartidorService
    ) {
        $this->pedidosService = $pedidosService;
        $this->pedidosDetailService = $pedidosDetailService;
        $this->pedidoEstadoService = $pedidoEstadoService;
        $this->repartidorService = $repartidorService;
    }
    public function store(PedidosStoreRequest $request)
    {
        try {
            // Lógica para crear el nuevo registro pedido
            $data = $request->validated();
            $data["user"] = $request["user"];
            $pedido = $this->pedidosService->store($data);
            if ($pedido) {
                $this->pedidosDetailService->store($pedido->id, $data);
            }
            return response()->json(['message' => 'Se registró pedido.'], 201);
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
        $pedido = $this->pedidosService->edit($id);
        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }
        $estados = $this->pedidoEstadoService->getEstadosNext($pedido->estado_id);
        return response()->json(["pedido" => $pedido, "estados" => $estados]);
    }

    public function changeState(PedidoChangeStateRequest $request, $id)
    {
        try {
            $data = $request->validated();

            //Buscar pedido
            $pedido = $this->pedidosService->edit($id);
            if (!$pedido) {
                return response()->json(['error' => 'Pedido no encontrado'], 404);
            }

            //Validar que se asigne usuario rol repartidor para estado EN DELIVERY
            $estado_id = $data["estado_id"];
            if ($estado_id == 3) {
                $repartidor = $this->repartidorService->validateRepartidor($data["repartidor_id"]);
                if (is_null($repartidor)) {
                    return response()->json(['error' => 'Debe asignar un usuario repartidor'], 409);
                }
            }

            //Comparar nuevo estado / estado actual, no permitir retroceder estado
            $check_estado = $this->pedidoEstadoService->checkState($pedido->estado_id, $estado_id);
            if(!$check_estado){
                return response()->json(['error' => 'No puede regresar a un estado anterior'], 409);
            }

            // Lógica para actualizar producto
            $producto = $this->pedidosService->changeState($pedido, $data);
            return response()->json([
                'message' => 'Se actualizó estado pedido.'
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
        //Obtener lista de pedidos/detalle y mostrarlo en el datatable
        $pedidos = $this->pedidosService->getPedidosList($request);
        return response()->json($pedidos);
    }
}
