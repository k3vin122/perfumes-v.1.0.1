<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Compra;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

use App\Models\Venta;

use App\Models\VentaCabecera;

use App\Models\Producto;

use App\Models\VentaCredito;

use App\Models\DetalleVentaCredito;

use App\Models\PagoVentaCredito;

use App\Models\Dinerobanco;


class CompraController extends Controller
{
   public function index()
{
    $compras = Compra::all();

    $totalMontoComprado = $compras->sum('monto_comprado');
    $totalValorDespacho = $compras->sum('valor_despacho');
    $totalComprasPersonales = $compras->sum('compras_personales');
    $totalMontoNeto = $compras->sum(function ($compra) {
        return $compra->monto_comprado + $compra->valor_despacho - $compra->compras_personales;
    });

    return view('compras.index', compact(
        'compras',
        'totalMontoComprado',
        'totalValorDespacho',
        'totalComprasPersonales',
        'totalMontoNeto'
    ));
}

    public function create()
    {
        $compra = new Compra(); // crea un objeto vacío para evitar null
        return view('compras.create', compact('compra'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'numero_boleta' => 'required',
        'numero_orden_compra' => 'nullable',
        'fecha' => 'required|date',
        'tienda' => 'required',
        'categoria' => 'required',

        'monto_comprado' => 'required|numeric|min:0',
        'valor_despacho' => 'nullable|numeric|min:0',
        'archivo_boleta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'compras_personales' => 'nullable|numeric|min:0',
    ]);

    // Calcular el total antes de restar 'compras_personales'
    $total = $validated['monto_comprado'] + ($validated['valor_despacho'] ?? 0);

    // Restar 'compras_personales' si existe
    if (isset($validated['compras_personales']) && $validated['compras_personales'] > 0) {
        $total -= $validated['compras_personales'];
    }

    $validated['total'] = $total;

    // Si se ha subido un archivo, guardarlo
    if ($request->hasFile('archivo_boleta')) {
        $validated['archivo_boleta'] = $request->file('archivo_boleta')->store('boletas', 'public');
    }

    // Crear la compra en la base de datos
    Compra::create($validated);

    // **Nuevo paso:** Descontar el dinero en la tabla 'dinerobanco'
    $dineroBanco = DineroBanco::first();

    // Si no existe un registro en la tabla dinero banco, lo creamos
    if (!$dineroBanco) {
        $dineroBanco = new DineroBanco();
        $dineroBanco->dinero = 0;
        $dineroBanco->save();
    }

    // Descontar el total de la compra del campo 'dinero' de la tabla dinerobanco
    $dineroBanco->dinero -= $total;

    // Si el descuento genera un valor negativo, podemos manejarlo con una validación.
    // Si prefieres evitar que el saldo sea negativo, podrías hacer algo como esto:
    if ($dineroBanco->dinero < 0) {
        return redirect()->back()->withErrors(['error' => 'No hay suficiente dinero en el banco para realizar la compra.']);
    }

    $dineroBanco->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Buscar la compra por id o fallar con 404 si no existe
        $compra = Compra::findOrFail($id);

        // Retornar la vista con los datos de la compra para editar
        return view('compras.edit', compact('compra'));
    }

   public function update(Request $request, $id)
{
    $compra = Compra::findOrFail($id);

    // 1. Validar datos y asignar a $validatedData
    $validatedData = $request->validate([
        'numero_boleta' => 'required|string|max:255',
        'numero_orden_compra' => 'nullable|string|max:255',
        'fecha' => 'required|date',
        'categoria' => 'required',
        'tienda' => 'required|string|max:255',
        'monto_comprado' => 'required|numeric|min:0',
        'valor_despacho' => 'nullable|numeric|min:0',
        'archivo_boleta' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',
        'compras_personales' => 'nullable|numeric|min:0',
    ]);

    // 2. Calcular total
    $total = $validatedData['monto_comprado'] + ($validatedData['valor_despacho'] ?? 0);

    // 3. Restar 'compras_personales' si existe
    if (isset($validatedData['compras_personales']) && $validatedData['compras_personales'] > 0) {
        $total -= $validatedData['compras_personales'];
    }

    // 4. Procesar archivo si se subió uno nuevo
    if ($request->hasFile('archivo_boleta')) {
        // Eliminar archivo anterior si existe
        if ($compra->archivo_boleta && \Storage::exists('public/' . $compra->archivo_boleta)) {
            \Storage::delete('public/' . $compra->archivo_boleta);
        }
        // Guardar nuevo archivo
        $path = $request->file('archivo_boleta')->store('compras', 'public');
        $validatedData['archivo_boleta'] = $path;
    } else {
        // Mantener archivo anterior
        $validatedData['archivo_boleta'] = $compra->archivo_boleta;
    }

    // **Nuevo paso: Calcular la diferencia entre el total anterior y el nuevo total**
    $diferenciaTotal = $total - $compra->total;  // Calcula la diferencia entre el nuevo total y el total anterior

    // 5. Actualizar datos con todos los campos, incluido 'categoria' y 'total'
    $compra->update([
        'numero_boleta' => $validatedData['numero_boleta'],
        'numero_orden_compra' => $validatedData['numero_orden_compra'],
        'fecha' => $validatedData['fecha'],
        'tienda' => $validatedData['tienda'],
        'categoria' => $validatedData['categoria'],
        'monto_comprado' => $validatedData['monto_comprado'],
        'valor_despacho' => $validatedData['valor_despacho'] ?? 0,
        'compras_personales' => $validatedData['compras_personales'] ?? 0,
        'total' => $total,  // Aquí usamos el total actualizado
        'archivo_boleta' => $validatedData['archivo_boleta'],
    ]);

    // **Nuevo paso:** Ajustar el saldo en 'dinerobanco' según la diferencia
    $dineroBanco = DineroBanco::first();

    // Si no existe un registro en la tabla dinero banco, lo creamos
    if (!$dineroBanco) {
        $dineroBanco = new DineroBanco();
        $dineroBanco->dinero = 0;
        $dineroBanco->save();
    }

    // Si la diferencia es positiva, restamos del saldo de 'dinero' en 'dinerobanco'
    if ($diferenciaTotal > 0) {
        $dineroBanco->dinero -= $diferenciaTotal;  // Descontamos el aumento
    } else {
        // Si la diferencia es negativa (es decir, el total ha disminuido), sumamos esa diferencia
        $dineroBanco->dinero += abs($diferenciaTotal);  // Sumamos la disminución
    }

    // Validar que no se quede con un saldo negativo en 'dinero'
    if ($dineroBanco->dinero < 0) {
        return redirect()->back()->withErrors(['error' => 'No hay suficiente dinero en el banco para realizar esta actualización.']);
    }

    $dineroBanco->save();

    // 6. Redireccionar con mensaje de éxito
    return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
}


    public function destroy($id)
    {
        // Buscar el registro por ID o fallar con 404 si no existe
        $compra = Compra::findOrFail($id);

        // Eliminar el archivo de boleta si existe (opcional)
        if ($compra->archivo_boleta) {
            Storage::delete('public/' . $compra->archivo_boleta);
        }

        // Eliminar el registro de la base de datos
        $compra->delete();

        // Redireccionar con mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }
}