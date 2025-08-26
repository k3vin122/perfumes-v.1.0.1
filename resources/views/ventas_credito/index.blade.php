@extends('layouts.app')

@section('content')
    <div class="container py-5">

      <!-- Encabezado con botón -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0 text-primary fw-bold">📦 Ventas a Crédito</h1>
    <a href="{{ route('ventas_credito.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Agregar nuevo crédito
    </a>
</div>
        <!-- Filtros -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('ventas_credito.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="cliente_nombre" class="form-label">Cliente</label>
                        <input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control"
                            value="{{ request('cliente_nombre') }}" placeholder="Buscar por cliente">
                    </div>

                    <div class="col-md-2">
                        <label for="fecha_inicio" class="form-label">Desde</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ request('fecha_inicio') }}">
                    </div>

                    <div class="col-md-2">
                        <label for="fecha_fin" class="form-label">Hasta</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="{{ request('fecha_fin') }}">
                    </div>

                    <div class="col-md-2">
                        <label for="zona" class="form-label">Zona</label>
                        <select name="zona" id="zona" class="form-select">
                            <option value="">Todas</option>
                            <option value="Norte" {{ request('zona') == 'Norte' ? 'selected' : '' }}>Norte</option>
                            <option value="Sur" {{ request('zona') == 'Sur' ? 'selected' : '' }}>Sur</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <label class="form-label invisible">Buscar</label>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
           <table class="table table-bordered table-hover shadow-sm align-middle">
    <thead class="table-primary">
        <tr class="text-center">
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Zona</th>
            <th>Productos</th>
            <th>Total</th>
            <th>Pagado</th>
            <th>Saldo Pendiente</th>
            <th class="text-center">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ventas as $venta)
            <tr>
                <td class="text-center">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                <td>{{ $venta->cliente_nombre }}</td>
                <td class="text-center">
                    <span class="badge bg-{{ $venta->zona == 'Norte' ? 'info' : 'success' }}">
                        {{ $venta->zona }}
                    </span>
                </td>
                <td>
                    <ul class="list-unstyled mb-0">
                        @foreach ($venta->detalles as $detalle)
                            <li>
                                <span data-bs-toggle="tooltip"
                                      data-bs-html="true"
                                      title="<img src='{{ asset('storage/app/public/' . $detalle->producto->imagen) }}' width='120' class='rounded shadow' />">
                                    {{ $detalle->producto->producto ?? 'Sin nombre' }} x {{ $detalle->cantidad }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-end">${{ number_format($venta->total, 0, ',', '.') }}</td>
                <td class="text-end">${{ number_format($venta->abono_inicial + $venta->pagos->sum('monto'), 0, ',', '.') }}</td>
                <td class="text-end text-danger fw-bold">
                    ${{ number_format($venta->total - ($venta->abono_inicial + $venta->pagos->sum('monto')), 0, ',', '.') }}
                </td>
                <td class="text-center">
                    <a href="{{ route('ventas_credito.show', $venta->id) }}"
                       class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Agregar Pago
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted">No se encontraron ventas</td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>

        <!-- Totales -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total General</h6>
                        <p class="fw-bold text-primary">${{ number_format($totalGeneral, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Pagado</h6>
                        <p class="fw-bold text-success">${{ number_format($totalPagado, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Pendiente</h6>
                        <p class="fw-bold text-danger">${{ number_format($totalSaldoPendiente, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Norte / Sur</h6>
                        <p>
                            <span class="text-info fw-bold">Norte:
                                ${{ number_format($totalNorte, 0, ',', '.') }}</span><br>
                            <span class="text-success fw-bold">Sur: ${{ number_format($totalSur, 0, ',', '.') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paginación -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $ventas->links() }}
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endpush
