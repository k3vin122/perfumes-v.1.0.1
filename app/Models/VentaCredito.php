<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class VentaCredito extends Model
{
    protected $table = 'ventas_credito';

    protected $fillable = [
        'cliente_nombre',
        'fecha',
        'zona',
        'cuotas',
        'interes',
        'abono_inicial',
        'total',
         'notas'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVentaCredito::class);
    }

    public function pagos()
    {
        return $this->hasMany(PagoVentaCredito::class);
    }
}