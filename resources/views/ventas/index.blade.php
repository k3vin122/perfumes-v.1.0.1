@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Mensaje de éxito con botón de boleta --}}
        @if (session('voucher_id'))
            <div class="alert alert-success d-flex justify-content-between align-items-center">
                <div>
                    Venta registrada correctamente.
                </div>
                <a href="{{ route('ventas.voucher', session('voucher_id')) }}" class="btn btn-sm btn-outline-primary"
                    target="_blank">
                    <i class="bi bi-file-earmark-pdf"></i> Descargar Boleta PDF
                </a>
            </div>
        @endif

        {{-- Toast bienvenida --}}
        @if (session('welcome'))
            <div aria-live="polite" aria-atomic="true" class="position-fixed top-50 start-50 translate-middle p-3"
                style="z-index: 1080;">
                <div id="welcomeToast" class="toast show align-items-center text-bg-success border-0 shadow" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('welcome') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var toastEl = document.getElementById('welcomeToast');
                    if (toastEl) {
                        new bootstrap.Toast(toastEl, {
                            delay: 5000
                        }).show();
                    }
                });
            </script>
        @endif

        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">🛒 Listado de Ventas</h1>
            <a href="{{ route('ventas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Agregar Venta
            </a>
        </div>

        {{-- Botón exportar --}}
        <div class="mb-3">
            <a href="{{ route('ventas.exportar.excel', request()->all()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
            </a>
        </div>

        {{-- Totales --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-primary mb-1">Total Ventas Norte</h6>
                        <h5 class="mb-0">${{ number_format($totalNorte, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-success mb-1">Total Ventas Sur</h6>
                        <h5 class="mb-0">${{ number_format($totalSur, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-dark shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-dark mb-1">Total General</h6>
                        <h5 class="mb-0">${{ number_format($totalGeneral, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtro buscador --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('ventas.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="producto" class="form-label">Producto</label>
                        <input type="text" name="producto" id="producto" class="form-control"
                            value="{{ request('producto') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ request('fecha_inicio') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="{{ request('fecha_fin') }}">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                @if (session('boleta_path'))
                    <br>
                    <a href="{{ asset('storage/' . session('boleta_path')) }}" target="_blank"
                        class="btn btn-sm btn-success mt-2">
                        <i class="bi bi-download"></i> Descargar Boleta PDF
                    </a>
                @endif
            </div>
        @endif

        {{-- Tabla de ventas --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Imagen</th>
                                <th>Zona</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->id }}</td>
                                    <td>{{ $venta->producto->producto }}</td>
                                    <td>
                                        @if ($venta->producto->imagen)
                                            <img src="{{ url('archivos/' . $venta->producto->imagen) }}"
     alt="Imagen del producto"
     class="rounded shadow-sm"
     style="width: 100px; height: 100px; object-fit: cover;">

                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-primary">{{ $venta->zona }}</span></td>
                                    <td>{{ $venta->cantidad_vendida }}</td>
                                    <td>${{ number_format($venta->precio_unitario, 0, ',', '.') }}</td>
                                    <td><strong>${{ number_format($venta->total, 0, ',', '.') }}</strong></td>
                                    <td>{{ $venta->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No hay ventas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="card-footer d-flex justify-content-center">
                {{ $ventas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
