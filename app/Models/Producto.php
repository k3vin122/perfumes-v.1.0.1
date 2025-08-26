<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
    'sku',
    'marca',
    'producto',
    'genero',
    'valor_compra',
    'valor_venta_sur',
    'valor_venta_norte',
    'ganancia_sur',
    'ganancia_norte',
    'imagen',
    'cantidad',
    'sucursal', 
    'notas', 
    ];
}