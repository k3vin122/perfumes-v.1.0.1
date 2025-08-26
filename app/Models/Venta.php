<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'venta_cabecera_id',
        'zona',
        'cantidad_vendida',
        'precio_unitario',
        'total',
    ];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }


    public function cabecera()
    {
        return $this->belongsTo(VentaCabecera::class, 'venta_cabecera_id');
    }



}