@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header text-center bg-primary text-white">
                <h3>Editar Compra</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('compras.update', $compra->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="numero_boleta" class="form-label fw-semibold">Número de Boleta:</label>
                        <input type="text" name="numero_boleta" id="numero_boleta"
                            value="{{ old('numero_boleta', $compra->numero_boleta) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero_orden_compra" class="form-label fw-semibold">Número Orden de Compra
                            (opcional):</label>
                        <input type="text" name="numero_orden_compra" id="numero_orden_compra"
                            value="{{ old('numero_orden_compra', $compra->numero_orden_compra) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-semibold">Fecha:</label>
                        <input type="date" name="fecha" id="fecha"
                            value="{{ old('fecha', \Carbon\Carbon::parse($compra->fecha)->format('Y-m-d')) }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        @php
                            $categoria = old('categoria', $compra->categoria ?? '');
                        @endphp

                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">Seleccione categoría</option>
                            <option value="C" {{ $categoria === 'C' ? 'selected' : '' }}>Capital</option>
                            <option value="G" {{ $categoria === 'G' ? 'selected' : '' }}>Ganancias</option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="compras_personales" class="form-label">Compras Personales ($)</label>
                        <input type="number" step="0.01" name="compras_personales" class="form-control"
                            value="{{ old('compras_personales', $compra->compras_personales ?? 0) }}" placeholder="0.00">
                    </div>

                    <div class="mb-3">
                        <label for="tienda" class="form-label fw-semibold">Tienda:</label>
                        <input type="text" name="tienda" id="tienda" value="{{ old('tienda', $compra->tienda) }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="monto_comprado" class="form-label fw-semibold">Monto Comprado:</label>
                        <input type="number" step="0.01" name="monto_comprado" id="monto_comprado"
                            value="{{ old('monto_comprado', $compra->monto_comprado) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="valor_despacho" class="form-label fw-semibold">Valor Despacho (opcional):</label>
                        <input type="number" step="0.01" name="valor_despacho" id="valor_despacho"
                            value="{{ old('valor_despacho', $compra->valor_despacho) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="archivo_boleta" class="form-label fw-semibold">Archivo Boleta (imagen o PDF):</label>
                        <input type="file" name="archivo_boleta" id="archivo_boleta" class="form-control">
                        @if ($compra->archivo_boleta)
                            <small class="form-text text-muted mt-1">
                                Archivo actual:
                                <a href="{{ asset('storage/' . $compra->archivo_boleta) }}" target="_blank"
                                    class="text-decoration-none">
                                    Ver archivo
                                </a>
                            </small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">Actualizar</button>
                </form>

                <a href="{{ route('compras.index') }}" class="btn btn-link mt-3 d-block text-center">
                    &larr; Volver al listado
                </a>
            </div>
        </div>
    </div>
@endsection
