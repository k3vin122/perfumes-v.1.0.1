@extends('layouts.app')

@section('content')
    <div class="container py-5" style="max-width: 800px;">
        <div class="mb-4 text-center">
            <h1 class="h3 fw-bold">Registrar Venta a Crédito</h1>
        </div>

        {{-- ⚠️ Alerta de interés adicional --}}
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
            <div class="fs-6">
                Recuerda: Se aplica <strong>0% de interés</strong> Recuerda que la primera cuota se cancela enseguida.
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('ventas_credito.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="cliente_nombre" class="form-label fw-semibold">Cliente</label>
                            <input type="text" id="cliente_nombre" name="cliente_nombre"
                                class="form-control form-control-lg" placeholder="Nombre del cliente" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="fecha" class="form-label fw-semibold">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control form-control-lg"
                                required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zona" class="form-label fw-semibold">Zona</label>
                            <select id="zona" name="zona" class="form-select form-select-lg" required>
                                <option value="" selected disabled>Seleccione...</option>
                                <option value="Norte">Norte</option>
                                <option value="Sur">Sur</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4 align-items-end">
                        <div class="col-md-3 mb-3">
                            <label for="cuotas" class="form-label fw-semibold">Cuotas</label>
                            <input type="number" id="cuotas" name="cuotas" min="1"
                                class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="abono_inicial" class="form-label fw-semibold">Abono Inicial</label>
                            <input type="number" step="0.01" id="abono_inicial" name="abono_inicial" value="0"
                                class="form-control form-control-lg bg-light" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="notas" class="form-label fw-semibold">Notas</label>
                            <textarea id="notas" name="notas" class="form-control" rows="3"
                                placeholder="Desea agregar un detalle"></textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-semibold mb-3">Productos</h5>

                    <div id="productos">
                        <div class="row g-3 align-items-end producto-item mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Producto</label>
                                <select name="productos[0][producto_id]" class="form-select form-select-lg" required>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">
                                            {{ $producto->producto }} (Disponible: {{ $producto->cantidad }} - Sucursal:
                                            {{ $producto->sucursal }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Cantidad</label>
                                <input type="number" name="productos[0][cantidad]" min="1"
                                    class="form-control form-control-lg" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="agregarProducto()">
                            <i class="bi bi-plus-circle me-1"></i> Agregar Producto
                        </button>
                    </div>

                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-save me-2"></i> Guardar Venta
                        </button>
                    </div>

                    {{-- Botón Volver --}}
                    <div class="text-end">
                        <a href="{{ route('ventas_credito.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let index = 1;

        function agregarProducto() {
            const div = document.createElement('div');
            div.classList.add('row', 'g-3', 'align-items-end', 'producto-item', 'mb-3');
            div.innerHTML = `
        <div class="col-md-6">
            <label class="form-label fw-semibold">Producto</label>
            <select name="productos[${index}][producto_id]" class="form-select form-select-lg" required>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->producto }} (Disponible: {{ $producto->cantidad }} - Sucursal: {{ $producto->sucursal }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Cantidad</label>
            <input type="number" name="productos[${index}][cantidad]" min="1" class="form-control form-control-lg" required>
        </div>
    `;
            document.getElementById('productos').appendChild(div);
            index++;
        }
    </script>
@endsection