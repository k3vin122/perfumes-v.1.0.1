@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary fw-bold mb-0">
                <i class="bi bi-box-seam-fill me-2"></i>LOGÍSTICA COMPRA VENTA
            </h1>
            <a href="{{ route('compras.create') }}" class="btn btn-primary rounded-pill shadow-sm px-4">
                <i class="bi bi-plus-lg me-1"></i> Nueva Compra
            </a>
        </div>

        <!-- Tabla de compras -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>N° Boleta</th>
                                <th>N° Orden Compra</th>
                                <th>Fecha</th>
                                <th>Tienda</th>
                                <th>Categoría</th>
                                <th>Monto Comprado</th>
                                <th>Valor Despacho</th>
                                <th>Compras Personales</th>
                                <th>Monto Neto</th>
                                <th>Archivo Boleta</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($compras as $compra)
                                <tr class="{{ $compra->categoria === 'C' ? 'table-success' : '' }}">
                                    <td>{{ $compra->id }}</td>
                                    <td>{{ $compra->numero_boleta }}</td>
                                    <td>{{ $compra->numero_orden_compra ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $compra->tienda }}</td>
                                    <td>
                                        @switch($compra->categoria)
                                            @case('C') <span class="badge bg-success">Capital</span> @break
                                            @case('G') <span class="badge bg-warning text-dark">Ganancia</span> @break
                                            @default <span class="badge bg-secondary">Sin categoría</span>
                                        @endswitch
                                    </td>
                                    <td>${{ number_format($compra->monto_comprado, 2, ',', '.') }}</td>
                                    <td>${{ number_format($compra->valor_despacho, 2, ',', '.') }}</td>
                                    <td>${{ number_format($compra->compras_personales, 2, ',', '.') }}</td>
                                    <td>
                                        <strong class="text-success">
                                            ${{ number_format($compra->monto_comprado + $compra->valor_despacho - $compra->compras_personales, 2, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        @if ($compra->archivo_boleta)
                                            <a href="{{ asset('storage/' . $compra->archivo_boleta) }}" target="_blank"
                                               class="btn btn-sm btn-outline-secondary rounded-pill">
                                                <i class="bi bi-file-earmark-text me-1"></i>Ver Archivo
                                            </a>
                                        @else
                                            <span class="text-muted fst-italic">Sin archivo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('compras.edit', $compra->id) }}"
                                           class="btn btn-sm btn-warning rounded-pill mb-1">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        <form action="{{ route('compras.destroy', $compra->id) }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta compra?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                        No hay compras registradas aún.
                                    </td>
                                </tr>
                            @endforelse

                            <!-- Fila de totales -->
                            <tr class="table-light border-top fw-bold">
                                <td colspan="6" class="text-end text-primary">Totales generales:</td>
                                <td class="text-success">${{ number_format($totalMontoComprado, 2, ',', '.') }}</td>
                                <td class="text-success">${{ number_format($totalValorDespacho, 2, ',', '.') }}</td>
                                <td class="text-success">${{ number_format($totalComprasPersonales, 2, ',', '.') }}</td>
                                <td class="text-success">
                                    <i class="bi bi-cash-coin me-1"></i>
                                    <strong>${{ number_format($totalMontoNeto, 2, ',', '.') }}</strong>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
