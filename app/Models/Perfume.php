<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $fillable = [
    'marca',
    'producto',
    'genero',
    'precio',
    'notas_aroma',
    'imagen',
];
}
