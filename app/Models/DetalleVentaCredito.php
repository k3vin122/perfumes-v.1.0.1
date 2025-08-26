<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaCredito extends Model
{
    protected $table = 'detalle_venta_credito';

    protected $fillable = [
        'venta_credito_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function ventaCredito()
    {
        return $this->belongsTo(VentaCredito::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}