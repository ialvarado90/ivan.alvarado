<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware("oauth_private");

Route::group(array('prefix' => 'user', 'middleware' => ['oauth_private']), function () {
    Route::get('create', [UserController::class, 'create']);
    Route::post('store', [UserController::class, 'store']);
    Route::get('edit/{id}', [UserController::class, 'edit']);
    Route::post('change-pass', [UserController::class, 'changePass']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::post('datatable', [UserController::class, 'datatable']);
});

Route::group(array('prefix' => 'pedidos', 'middleware' => ['oauth_private']), function () {
    Route::post('store', [PedidosController::class, 'store']);
    Route::get('edit/{id}', [PedidosController::class, 'edit']);
    Route::put('change-state/{id}', [PedidosController::class, 'changeState']);
    Route::post('datatable', [PedidosController::class, 'datatable']);
});

Route::group(array('prefix' => 'productos', 'middleware' => ['oauth_private']), function () {
    Route::post('store', [ProductosController::class, 'store']);
    Route::get('edit/{id}', [ProductosController::class, 'edit']);
    Route::put('update/{id}', [ProductosController::class, 'update']);
    Route::post('datatable', [ProductosController::class, 'datatable']);
    Route::get('list', [ProductosController::class, 'list']);
});
