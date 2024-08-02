<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pedidos extends Authenticatable
{

    protected $table = 'pedidos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nro_pedido',
        'recepcion_at',
        'despacho_at',
        'entrega_at',
        'pedido_at',
        'vendedor_id',
        'repartidor_id',
        'estado_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
