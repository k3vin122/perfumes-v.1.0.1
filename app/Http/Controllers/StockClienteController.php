<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;


class StockClienteController extends Controller
{
public function index(Request $request)
{
    $query = \App\Models\Producto::query();

    $ip = $request->ip();

    // Filtro por sucursal (LIKE para coincidencia parcial)
    if ($request->filled('sucursal')) {
        $query->where('sucursal', 'like', '%' . $request->sucursal . '%');
    }

    // Filtro por marca (parcial)
    if ($request->filled('marca')) {
        $query->where('marca', 'like', '%' . $request->marca . '%');
    }

    // Filtro por género (parcial)
    if ($request->filled('genero')) {
        $query->where('genero', 'like', '%' . $request->genero . '%');
    }

    // Filtro por stock mínimo
    if ($request->filled('stock')) {
        $query->where('cantidad', '>=', $request->stock);
    }

    // Filtro por nombre de producto (parcial)
    if ($request->filled('producto')) {
        $query->where('producto', 'like', '%' . $request->producto . '%');
    }

    // Orden personalizado si se seleccionó alguna opción
    if ($request->filled('ordenar_por')) {
        $ordenarPor = $request->input('ordenar_por');

        if ($ordenarPor == 'fecha_ingreso') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy($ordenarPor, 'asc');
        }
    } else {
        // Orden por defecto: primero productos con stock > 1, luego por cantidad descendente, luego por nombre asc
        $query->orderByRaw('CASE WHEN cantidad > 1 THEN 0 ELSE 1 END')
              ->orderBy('cantidad', 'desc')
              ->orderBy('producto', 'asc');
    }

    // Paginación
    $productos = $query->paginate(10)->withQueryString();

    return view('stockCliente.index', compact('productos', 'ip'));
}



}
