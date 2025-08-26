<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoVentaCredito extends Model
{
    protected $table = 'pago_venta_creditos'; // o el nombre real

    protected $fillable = [
        'venta_credito_id',
        'fecha_pago',
        'monto',
    ];

    public function ventaCredito()
    {
        return $this->belongsTo(VentaCredito::class);
    }
}