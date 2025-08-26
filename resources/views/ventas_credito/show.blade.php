@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h1 class="mb-4">Detalle de Venta a Crédito</h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Cliente:</strong> {{ $venta->cliente_nombre }}</li>
                    <li class="list-group-item"><strong>Fecha:</strong>
                        {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Zona:</strong> {{ $venta->zona }}</li>
                    <li class="list-group-item"><strong>Cuotas:</strong> {{ $venta->cuotas }}</li>
                    <li class="list-group-item"><strong>Interés:</strong> {{ $venta->interes }}%</li>
                    <li class="list-group-item"><strong>Abono Inicial:</strong>
                        ${{ number_format($venta->abono_inicial, 0, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Total:</strong> ${{ number_format($venta->total, 0, ',', '.') }}</li>
                </ul>

                <div class="mt-3">
                    <h5>Notas</h5>
                    <div class="alert alert-danger">
                        {{ $venta->notas ?? 'Sin notas registradas.' }}
                    </div>
                </div>
            </div>
        </div>

        <h3>Productos</h3>
        <div class="table-responsive mb-4">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->producto }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                            <td>${{ number_format($detalle->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3>Pagos Realizados</h3>
        <div class="table-responsive mb-4">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Fecha Pago</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->pagos as $pago)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td>${{ number_format($pago->monto, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <p><strong>Total Abonado:</strong>
                ${{ number_format($venta->abono_inicial + $venta->pagos()->sum('monto'), 0, ',', '.') }}</p>
            <p><strong>Saldo Pendiente:</strong>
                ${{ number_format($venta->total - ($venta->abono_inicial + $venta->pagos()->sum('monto')), 0, ',', '.') }}
            </p>
        </div>

        <div class="mb-4">
            @php
                $valorCuota = $venta->cuotas > 0 ? $venta->total / $venta->cuotas : 0;
            @endphp

            <p><strong>Valor por Cuota:</strong> ${{ number_format($valorCuota, 0, ',', '.') }}</p>
        </div>

        <h3>Registrar Nuevo Pago</h3>
        <div class="card shadow-sm p-4 mb-5" style="max-width: 400px;">
            <form action="{{ route('ventas_credito.abonar', $venta->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fecha_pago" class="form-label">Fecha Pago:</label>
                    <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="monto" class="form-label">Monto:</label>
                    <input type="number" step="0.01" name="monto" id="monto" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Registrar pago de cuota
                </button>
            </form>
        </div>

        <div class="text-end mb-5">
            <a href="{{ route('ventas_credito.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Volver
            </a>
        </div>

    </div>
@endsection
