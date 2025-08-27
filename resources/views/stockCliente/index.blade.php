@extends('layouts.app')

@section('styles')
    <style>
        .img-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 110px;
            height: 110px;
            padding: 5px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .img-container {
            position: relative;
            overflow: hidden;
            max-width: 100px;
            max-height: 100px;
            border-radius: 8px;
        }

        .img-container img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .img-container:hover img {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">

        <!-- Título Principal -->
        <h1 class="mb-4 text-center text-primary fw-bold">📦 STOCK DISPONIBLE PÚBLICO</h1>

        <!-- Mensaje de Éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <!-- Botones y filtros -->
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">

            <a href="{{ route('productos.export') }}" class="btn btn-success btn-sm mb-3 mb-md-0">
                <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
            </a>

            <div class="btn-group flex-wrap">
                <form action="{{ route('productos.catalogo', 'Norte') }}" method="GET" target="_blank"
                    class="mb-2 mb-md-0 me-2">
                    <input type="hidden" name="sucursal" value="Rancagua">
                    <button type="submit" class="btn btn-outline-primary btn-sm shadow-sm">📄 Catálogo Norte
                        Rancagua</button>
                </form>

                <form action="{{ route('productos.catalogo', 'Sur') }}" method="GET" target="_blank" class="mb-2 mb-md-0">
                    <input type="hidden" name="sucursal" value="Puerto Varas">
                    <button type="submit" class="btn btn-outline-success btn-sm shadow-sm">📄 Catálogo Sur Puerto
                        Varas</button>
                </form>
            </div>
        </div>

        <!-- Filtros -->
        <form method="GET" action="{{ route('stockCliente.index') }}"
            class="row g-3 mb-4 shadow-sm p-3 rounded border bg-light">

            <div class="col-md-3">
                <label for="producto" class="form-label small fw-semibold">Producto</label>
                <input type="text" name="producto" id="producto" class="form-control form-control-sm"
                    value="{{ request('producto') }}" placeholder="Buscar producto...">
            </div>

            <div class="col-md-3">
                <label for="marca" class="form-label small fw-semibold">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control form-control-sm"
                    value="{{ request('marca') }}" placeholder="Buscar marca...">
            </div>

            <div class="col-md-2">
                <label for="genero" class="form-label small fw-semibold">Género</label>
                <select name="genero" id="genero" class="form-select form-select-sm">
                    <option value="" {{ request('genero') == '' ? 'selected' : '' }}>Todos</option>
                    <option value="Hombre" {{ request('genero') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="Mujer" {{ request('genero') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    <option value="Unisex" {{ request('genero') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="sucursal" class="form-label small fw-semibold">Sucursal</label>
                <select name="sucursal" id="sucursal" class="form-select form-select-sm">
                    <option value="" {{ request('sucursal') == '' ? 'selected' : '' }}>Todas</option>
                    <option value="Rancagua" {{ request('sucursal') == 'Rancagua' ? 'selected' : '' }}>Rancagua</option>
                    <option value="Puerto Varas" {{ request('sucursal') == 'Puerto Varas' ? 'selected' : '' }}>Puerto Varas
                    </option>
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </button>
                <a href="{{ route('stockCliente.index') }}" class="btn btn-outline-secondary btn-sm w-100">Limpiar</a>
            </div>
        </form>

        <!-- Tabla de Productos -->
        <div class="table-responsive shadow-sm rounded">
           <table class="table table-hover table-bordered align-middle mb-0">
    <thead class="table-primary text-center">
        <tr class="text-nowrap">
            <th>Marca</th>
            <th>Producto</th>
            <th>Género</th>
            <th>Venta Sur</th>
            <th>Venta Norte</th>
            <th>Stock</th>
            <th>Sucursal</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($productos as $producto)
            <tr class="{{ $producto->cantidad == 0 ? 'table-danger' : '' }}">
                <td class="table-secondary">{{ $producto->marca }}</td> <!-- Ejemplo de celda con color -->
                <td class="text-center producto-hover table-light">{{ $producto->producto }}</td>
                <td class="text-center table-info">{{ $producto->genero }}</td>
                <td class="text-end table-warning">${{ number_format($producto->valor_venta_sur, 0, ',', '.') }}</td>
                <td class="text-end table-warning">${{ number_format($producto->valor_venta_norte, 0, ',', '.') }}</td>
                <td class="text-center">
                    <span class="{{ $producto->cantidad == 0 ? 'text-danger fw-bold' : 'text-success fw-bold' }}">
                        {{ $producto->cantidad }}
                    </span>
                    @if ($producto->cantidad == 0)
                        <span class="text-danger fw-bold ms-1">
                            <i class="bi bi-exclamation-triangle-fill"></i> Sin stock
                        </span>
                    @endif
                </td>
                <td class="text-center table-light">{{ $producto->sucursal }}</td>
                <td class="text-center table-light">
                    @if ($producto->imagen)
                        <div class="img-wrapper">
                            <div class="img-container">
                                <img src="{{ url('archivos/' . $producto->imagen) }}" alt="Imagen" />
                            </div>
                        </div>
                    @else
                        <span class="text-muted fst-italic">Sin imagen</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted fst-italic py-3">
                    No hay productos registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $productos->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
