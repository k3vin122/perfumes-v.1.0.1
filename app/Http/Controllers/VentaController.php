<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Venta;
use App\Models\VentaCabecera;
use App\Models\Producto;

use App\Models\Dinerobanco;




use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VentasExport;


class VentaController extends Controller
{



    public function exportarVentasExcel(Request $request)
{
    // Si deseas agregar filtros, puedes hacerlo aquí como en el método para PDF.
    // Ejemplo:
    // $ventas = Venta::where('zona', 'Norte')->get();

    return Excel::download(new VentasExport(), 'ventas_listado.xlsx');
} 



    public function index(Request $request)
    {
        // Construye la query base
        $query = Venta::with('producto');

        // Filtros dinámicos
        if ($request->filled('producto')) {
            $query->whereHas('producto', function ($q) use ($request) {
                $q->where('producto', 'like', '%' . $request->producto . '%');
            });
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        // Clona la query para no perder filtros
        $queryNorte = (clone $query)->where('zona', 'Norte');
        $querySur = (clone $query)->where('zona', 'Sur');

        // Pagina resultados
        $ventas = $query->orderBy('created_at', 'desc')->paginate(10);

        // Totales filtrados
        $totalNorte = $queryNorte->sum('total');
        $totalSur = $querySur->sum('total');
        $totalGeneral = $query->sum('total');

        return view('ventas.index', compact('ventas', 'totalNorte', 'totalSur', 'totalGeneral'));
    }







    public function create()
    {
        $productos = \App\Models\Producto::all();
        return view('ventas.create', compact('productos'));
    }

 public function store(Request $request)
{
    $request->validate([
        'zona' => 'required|in:Norte,Sur',
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad_vendida' => 'required|integer|min:1',
    ]);

    \DB::beginTransaction();

    try {
        $zona = $request->zona;
        $productos = $request->productos;
        $totalVenta = 0;

        // Crear cabecera venta
        $ventaCabecera = VentaCabecera::create([
            'zona' => $zona,
            'total' => 0,
        ]);

        foreach ($productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $precio_unitario = $zona === 'Sur' ? $producto->valor_venta_sur : $producto->valor_venta_norte;

            if ($producto->cantidad < $item['cantidad_vendida']) {
                \DB::rollBack();
                return back()->withErrors(['stock' => "No hay suficiente stock para {$producto->producto}"]);
            }

            $totalItem = $precio_unitario * $item['cantidad_vendida'];

            Venta::create([
                'venta_cabecera_id' => $ventaCabecera->id,
                'producto_id' => $producto->id,
                'zona' => $zona,
                'cantidad_vendida' => $item['cantidad_vendida'],
                'precio_unitario' => $precio_unitario,
                'total' => $totalItem,
            ]);

            // Descontar stock
            $producto->cantidad -= $item['cantidad_vendida'];
            $producto->save();

            $totalVenta += $totalItem;

            // Aquí agregamos la parte para actualizar la tabla dinero banco
            $dineroBanco = DineroBanco::first();

            // Si no existe un registro en la tabla dinero banco, lo creamos
            if (!$dineroBanco) {
                $dineroBanco = new DineroBanco();
                $dineroBanco->dinero = 0;
                $dineroBanco->save();
            }

            // Actualizamos el total de dinero en la tabla dinero banco
            $dineroBanco->dinero += $totalItem;
            $dineroBanco->save();
        }

        // Actualizar total de la cabecera
        $ventaCabecera->update(['total' => $totalVenta]);

        \DB::commit();

        // Redirigir a index con mensaje y voucher_id para descarga PDF
        return redirect()
            ->route('ventas.index')
            ->with('success', 'Venta registrada correctamente.')
            ->with('voucher_id', $ventaCabecera->id);

    } catch (\Exception $e) {
        \DB::rollBack();
        return back()->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
    }
}





    public function voucher($id)
    {
    $ventaCabecera = VentaCabecera::with('ventas.producto')->findOrFail($id);

    $pdf = Pdf::loadView('ventas.boleta', compact('ventaCabecera'));

    return $pdf->download("boleta_venta_{$ventaCabecera->id}.pdf");
    }
}