<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineroBanco extends Model
{
    use HasFactory;

    protected $table = 'dinerobanco';

    protected $fillable = ['dinero'];

    // public $timestamps = false; // si no tienes created_at/updated_at
}
