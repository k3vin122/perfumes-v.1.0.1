<?php

// app/Http/Controllers/ProductoController.php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Producto::query();

        $ip = $request->ip();

        // Filtro por sucursal
        if ($request->filled('sucursal')) {
            $query->where('sucursal', $request->sucursal);
        }

        // Filtro por marca (parcial)
        if ($request->filled('marca')) {
            $query->where('marca', 'like', '%' . $request->marca . '%');
        }

        // Filtro por género
        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }

        // Filtro por stock mínimo
        if ($request->filled('stock')) {
            $query->where('cantidad', '>=', $request->stock);
        }

        // Filtro por nombre de producto (parcial)
        if ($request->filled('producto')) {
            $query->where('producto', 'like', '%' . $request->producto . '%');
        }

        // Ordenar: primero productos con stock > 1, luego por cantidad descendente
        $query->orderByRaw('CASE WHEN cantidad > 1 THEN 0 ELSE 1 END')
            ->orderBy('cantidad', 'desc');

        // Orden personalizado si se seleccionó alguna opción
        if ($request->filled('ordenar_por')) {
            $ordenarPor = $request->input('ordenar_por');

            if ($ordenarPor == 'fecha_ingreso') {
                $query->orderBy('created_at', 'desc');
            } else {
                $query->orderBy($ordenarPor, 'asc');
            }
        } else {
            // Orden por defecto (nombre del producto)
            $query->orderBy('producto', 'asc');
        }

        // Paginación
        $productos = $query->paginate(10)->withQueryString();

        return view('productos.index', compact('productos', 'ip'));
    }



    public function edit($id)
    {
        $producto = \App\Models\Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = \App\Models\Producto::findOrFail($id);

        $validated = $request->validate([
            'sku' => 'required|unique:productos,sku,' . $producto->id,
            'marca' => 'required',
            'producto' => 'required',
            'genero' => 'required|in:Hombre,Mujer,Unisex',
            'valor_compra' => 'required|numeric',
            'valor_venta_sur' => 'required|numeric',
            'valor_venta_norte' => 'required|numeric',
            'cantidad' => 'required|integer|min:0',
            'sucursal' => 'required|in:Rancagua,Puerto Varas',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notas' => 'nullable|string|max:500',

        ]);

        $validated['ganancia_sur'] = $validated['valor_venta_sur'] - $validated['valor_compra'];
        $validated['ganancia_norte'] = $validated['valor_venta_norte'] - $validated['valor_compra'];

        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen')->store('imagenes', 'public');
            $validated['imagen'] = $imagen;

            \Log::info('Imagen subida correctamente: ' . $imagen);
        } else {
            \Log::warning('No se recibió una imagen válida.');
        }

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }





    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        // Validar datos excepto sku porque será generado automáticamente
        $validated = $request->validate([
            'marca' => 'required',
            'producto' => 'required',
            'genero' => 'required|in:Hombre,Mujer,Unisex',
            'valor_compra' => 'required|numeric',
            'valor_venta_sur' => 'required|numeric',
            'valor_venta_norte' => 'required|numeric',
            'cantidad' => 'required|integer|min:0',
            'sucursal' => 'required|in:Rancagua,Puerto Varas',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'notas' => 'nullable|string|max:500',
        ]);

        // Obtener último SKU numérico para generar el siguiente
        $ultimoProducto = Producto::orderByRaw('CAST(sku AS UNSIGNED) DESC')->first();
        $ultimoSku = $ultimoProducto ? intval($ultimoProducto->sku) : 0;
        $nuevoSku = str_pad($ultimoSku + 1, 3, '0', STR_PAD_LEFT);

        $validated['sku'] = $nuevoSku;

        // Calcular ganancias automáticas
        $validated['ganancia_sur'] = $validated['valor_venta_sur'] - $validated['valor_compra'];
        $validated['ganancia_norte'] = $validated['valor_venta_norte'] - $validated['valor_compra'];

        // Subir imagen si hay archivo válido
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen')->store('imagenes', 'public');
            $validated['imagen'] = $imagen;
        }

        Producto::create($validated);

        return redirect()->route('productos.create')->with('success', 'Producto guardado correctamente con SKU ' . $nuevoSku);
    }

    public function catalogo(Request $request, $zona)
{
    // Validar que la zona sea válida
    if (!in_array($zona, ['Norte', 'Sur'])) {
        return abort(404, 'Zona no válida.');
    }

    // Obtener la sucursal desde la solicitud (query o formulario)
    $sucursal = $request->input('sucursal');

    // Validar sucursal
    if (!in_array($sucursal, ['Rancagua', 'Puerto Varas'])) {
        return abort(404, 'Sucursal no válida.');
    }

    // Filtrar productos con stock > 0 y por sucursal
    $productos = Producto::where('cantidad', '>', 0)->where('sucursal', $sucursal)->get();

    // Agregar la ruta absoluta de la imagen a cada producto
    $productos->map(function ($producto) {
        $producto->imagen_path = storage_path('app/public/' . $producto->imagen);
        return $producto;
    });

    // Cálculo total de la zona
    $totalZona = $productos->sum(function ($producto) use ($zona) {
        $precio = $zona == 'Norte' ? $producto->valor_venta_norte : $producto->valor_venta_sur;
        return $producto->cantidad * $precio;
    });

    // Cargar el PDF
    $pdf = Pdf::loadView('productos.catalogo', [
        'productos' => $productos,
        'zona' => $zona,
        'sucursal' => $sucursal,
        'totalZona' => $totalZona,
    ]);

    return $pdf->stream("catalogo_{$zona}_{$sucursal}.pdf");
}




    
}
