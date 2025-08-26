<?php

namespace App\Http\Controllers;

use App\Models\VentaCredito;
use App\Models\DetalleVentaCredito;
use App\Models\PagoVentaCredito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dinerobanco;


class VentaCreditoController extends Controller
{
    /**
     * Muestra listado de ventas a crédito.
     */
    public function index(Request $request)
    {
        $ventasQuery = VentaCredito::with('detalles.producto');

        if ($request->filled('cliente_nombre')) {
            $ventasQuery->where('cliente_nombre', 'like', '%' . $request->cliente_nombre . '%');
        }

        if ($request->filled('fecha_inicio')) {
            $ventasQuery->whereDate('fecha', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $ventasQuery->whereDate('fecha', '<=', $request->fecha_fin);
        }

        // ✅ Nuevo filtro por zona
        if ($request->filled('zona')) {
            $ventasQuery->where('zona', $request->zona);
        }

        $ventas = $ventasQuery->orderBy('fecha', 'desc')->paginate(10);

        // Totales generales
        $totalGeneral = $ventasQuery->sum('total');
        $totalPagado = PagoVentaCredito::whereIn('venta_credito_id', $ventasQuery->get()->pluck('id'))->sum('monto');

        $totalSaldoPendiente = 0;
        foreach ($ventasQuery->get() as $venta) {
            $saldo = $venta->total - ($venta->abono_inicial + $venta->pagos()->sum('monto'));
            $totalSaldoPendiente += $saldo;
        }

        // Totales por zona
        $totalNorte = (clone $ventasQuery)->where('zona', 'Norte')->sum('total');
        $totalSur = (clone $ventasQuery)->where('zona', 'Sur')->sum('total');

        // ✅ Saldos pendientes por zona
        $saldoPendienteNorte = 0;
        foreach ((clone $ventasQuery)->where('zona', 'Norte')->get() as $venta) {
            $saldo = $venta->total - ($venta->abono_inicial + $venta->pagos()->sum('monto'));
            $saldoPendienteNorte += $saldo;
        }

        $saldoPendienteSur = 0;
        foreach ((clone $ventasQuery)->where('zona', 'Sur')->get() as $venta) {
            $saldo = $venta->total - ($venta->abono_inicial + $venta->pagos()->sum('monto'));
            $saldoPendienteSur += $saldo;
        }

        return view('ventas_credito.index', compact(
            'ventas',
            'totalGeneral',
            'totalSaldoPendiente',
            'totalNorte',
            'totalSur',
            'totalPagado',
            'saldoPendienteNorte',
            'saldoPendienteSur'
        ));
    }



    /**
     * Muestra formulario para crear una nueva venta a crédito.
     */
    public function create(Request $request)
    {
        // Trae productos con cantidad disponible > 0
        $productos = Producto::where('cantidad', '>', 0)->get();

        return view('ventas_credito.create', compact('productos'));
    }

    /**
     * Guarda la venta a crédito.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            // Crear la venta a crédito
            $venta = VentaCredito::create([
                'cliente_nombre' => $request->cliente_nombre,
                'fecha' => $request->fecha,
                'zona' => $request->zona,
                'cuotas' => $request->cuotas,
                'interes' => 0,
                'abono_inicial' => $request->abono_inicial ?? 0,
                'total' => 0, // Se recalcula abajo
                'notas' => $request->notas ?? null,
            ]);

            $total = 0;

            foreach ($request->productos as $productoData) {
                $producto = Producto::find($productoData['producto_id']);

                if ($productoData['cantidad'] > $producto->cantidad) {
                    throw new \Exception('Cantidad insuficiente para el producto: ' . $producto->producto);
                }

                $precioZona = $request->zona == 'Sur' ? $producto->valor_venta_sur : $producto->valor_venta_norte;

                $subtotal = $precioZona * $productoData['cantidad'];

                // Crear detalle de venta
                DetalleVentaCredito::create([
                    'venta_credito_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $productoData['cantidad'],
                    'precio_unitario' => $precioZona,
                    'subtotal' => $subtotal,
                ]);

                // Descontar cantidad disponible
                $producto->cantidad -= $productoData['cantidad'];
                $producto->save();

                $total += $subtotal;
            }

            // Aplicar interés del 15%
            $totalConInteres = $total + $total * ($venta->interes / 100);

            // Restar abono inicial si existe
            $totalFinal = $totalConInteres - $venta->abono_inicial;

            $venta->total = $totalFinal;

            $venta->save();
        });

        return redirect()->route('ventas_credito.index')->with('success', 'Venta a crédito registrada correctamente.');
    }

    /**
     * Muestra detalle de una venta a crédito.
     */
    public function show($id)
    {
        $venta = VentaCredito::with(['detalles.producto', 'pagos'])->findOrFail($id);

        return view('ventas_credito.show', compact('venta'));
    }

    /**
     * Registra un pago posterior (abono).
     */
    public function abonar(Request $request, $id)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:1',
        ]);

        $venta = VentaCredito::findOrFail($id);

        // Registrar el pago en la tabla PagoVentaCredito
        PagoVentaCredito::create([
            'venta_credito_id' => $venta->id,
            'fecha_pago' => $request->fecha_pago,
            'monto' => $request->monto,
        ]);

        // Actualizar el dinero en la tabla dinerobanco
        $dineroBanco = DineroBanco::first();

        // Si no existe un registro en la tabla dinero banco, lo creamos
        if (!$dineroBanco) {
            $dineroBanco = new DineroBanco();
            $dineroBanco->dinero = 0;
            $dineroBanco->save();
        }

        // Sumar el monto abonado al campo dinero
        $dineroBanco->dinero += $request->monto;
        $dineroBanco->save();

        return redirect()->back()->with('success', 'Abono registrado correctamente.');
    }

}