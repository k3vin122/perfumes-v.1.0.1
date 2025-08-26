<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaCabecera extends Model
{
    use HasFactory;

    protected $table = 'ventas_cabecera';

    protected $fillable = ['zona', 'total'];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'venta_cabecera_id');
    }
}