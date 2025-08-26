<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'numero_boleta',
        'numero_orden_compra',
        'fecha',
        'tienda',
        'monto_comprado',
        'valor_despacho',
        'total',
        'archivo_boleta',
        'categoria', 
        'compras_personales',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];
}
