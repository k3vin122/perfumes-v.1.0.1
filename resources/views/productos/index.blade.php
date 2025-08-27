@extends('layouts.app')

@section('styles')
    <style>
        .img-container {
            position: relative;
            overflow: hidden;
            max-width: 100px;
            /* Limita el tamaño máximo del contenedor */
            max-height: 100px;
            /* Limita la altura máxima de las imágenes */
        }

        .img-container img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
            /* Suaviza el efecto */
        }

        .img-container:hover img {
            transform: scale(1.05);
            /* Agranda la imagen al pasar el cursor, pero menos que antes */
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">

        <!-- Título Principal -->
        <h1 class="mb-4 text-center text-primary fw-bold">📦 Listado de Productos</h1>

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
            <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm shadow-sm w-100 w-md-auto">
                <i class="bi bi-plus-circle"></i> Nuevo Producto
            </a>
            <a href="{{ route('productos.export') }}" class="btn btn-success btn-sm mb-3 mb-md-0">
                <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
            </a>

            <!-- Botones de Exportación -->
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
        <form method="GET" action="{{ route('productos.index') }}"
            class="row row-cols-1 row-cols-md-auto g-3 align-items-end mb-4 shadow-sm p-3 rounded border bg-light">
            <div class="col">
                <label for="ordenar_por" class="form-label mb-0 small">Ordenar por</label>
                <select name="ordenar_por" id="ordenar_por" class="form-select form-select-sm">
                    <option value="">Seleccione</option>
                    <option value="fecha_ingreso" {{ request('ordenar_por') == 'fecha_ingreso' ? 'selected' : '' }}>Fecha de
                        Ingreso</option>
                    <option value="producto" {{ request('ordenar_por') == 'producto' ? 'selected' : '' }}>Nombre de Producto
                    </option>
                </select>
            </div>

            <div class="col">
                <label for="sucursal" class="form-label mb-0 small">Sucursal</label>
                <select name="sucursal" id="sucursal" class="form-select form-select-sm">
                    <option value="">Todas</option>
                    <option value="Rancagua" {{ request('sucursal') == 'Rancagua' ? 'selected' : '' }}>Rancagua</option>
                    <option value="Puerto Varas" {{ request('sucursal') == 'Puerto Varas' ? 'selected' : '' }}>Puerto Varas
                    </option>
                </select>
            </div>

            <div class="col">
                <label for="producto" class="form-label mb-0 small">Producto</label>
                <input type="text" name="producto" id="producto" class="form-control form-control-sm"
                    value="{{ request('producto') }}">
            </div>

            <div class="col">
                <label for="marca" class="form-label mb-0 small">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control form-control-sm"
                    value="{{ request('marca') }}">
            </div>

            <div class="col">
                <label for="genero" class="form-label mb-0 small">Género</label>
                <select name="genero" id="genero" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    <option value="Hombre" {{ request('genero') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="Mujer" {{ request('genero') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    <option value="Unisex" {{ request('genero') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                </select>
            </div>

            <div class="col">
                <label for="stock" class="form-label mb-0 small">Stock &gt;=</label>
                <input type="number" name="stock" id="stock" class="form-control form-control-sm"
                    value="{{ request('stock') }}">
            </div>

            <div class="col text-md-end">
                <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-funnel"></i> Filtrar</button>
                <a href="{{ route('productos.index') }}" class="btn btn-sm btn-outline-secondary">Limpiar</a>
            </div>
        </form>

        <!-- Tabla de Productos -->
        <div class="table-responsive-sm shadow-sm rounded">

            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="table-active text-center text-nowrap">
                        <th>SKU</th>
                        <th>Marca</th>
                        <th>Producto</th>
                        <th>Género</th>
                        <th>Compra</th>
                        <th>Venta Sur</th>
                        <th>Venta Norte</th>
                        <th>Ganancia Sur</th>
                        <th>Ganancia Norte</th>
                        <th>Stock</th>
                        <th>Sucursal</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr class="{{ $producto->cantidad == 0 ? 'table-danger' : '' }}">
                            <th scope="row" class="text-center fw-semibold">{{ $producto->sku }}</th>
                            <td>{{ $producto->marca }}</td>
                            <td class="text-center producto-hover">{{ $producto->producto }}</td>
                            <td class="text-center">{{ $producto->genero }}</td>
                            <td class="text-end">${{ number_format($producto->valor_compra, 0, ',', '.') }}</td>
                            <td class="text-end">${{ number_format($producto->valor_venta_sur, 0, ',', '.') }}</td>
                            <td class="text-end">${{ number_format($producto->valor_venta_norte, 0, ',', '.') }}</td>
                            <td class="text-end">${{ number_format($producto->ganancia_sur, 0, ',', '.') }}</td>
                            <td class="text-end">${{ number_format($producto->ganancia_norte, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span
                                    class="{{ $producto->cantidad == 0 ? 'text-danger fw-bold' : 'text-success fw-bold' }}">
                                    {{ $producto->cantidad }}
                                </span>
                                @if ($producto->cantidad == 0)
                                    <span class="text-danger fw-bold ms-1">
                                        <i class="bi bi-exclamation-triangle-fill"></i> Sin stock
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">{{ $producto->sucursal }}</td>
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
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('productos.edit', $producto->id) }}">
                                                <i class="bi bi-pencil-square me-2"></i> Editar
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr class="table-active">
                            <td colspan="13" class="text-center text-muted fst-italic py-3">
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
