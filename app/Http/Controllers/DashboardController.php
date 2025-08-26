<?php

namespace App\Http\Controllers;

use App\Models\Venta;

use App\Models\Producto;
use Illuminate\Support\Facades\DB; // ✅ IMPORTA DB aquí

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ejemplo: Ventas agrupadas por mes
        $ventasPorMes = Venta::selectRaw('MONTH(created_at) as mes, SUM(total) as total')->groupBy('mes')->orderBy('mes')->get();

        // Ventas por zona
        $ventasPorZona = Venta::selectRaw('zona, SUM(total) as total')->groupBy('zona')->get();

        $productos = Producto::all();

        // Para gráfico de barras: top 5 productos con más stock
        $topStock = Producto::orderByDesc('cantidad')
            ->take(5)
            ->get(['producto', 'cantidad']);

        // Para gráfico de pastel: stock total agrupado por género
        $stockPorGenero = Producto::select('genero', DB::raw('SUM(cantidad) as total'))->groupBy('genero')->get();

        return view('dashboard.index', compact('ventasPorMes', 'ventasPorZona', 'productos', 'topStock', 'stockPorGenero'));
    }
}
