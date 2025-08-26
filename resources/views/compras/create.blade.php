@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Registrar Compra</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- ⚠️ Alerta de interés adicional --}}
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
            <div class="fs-6">
                Recuerda:  Que si en tu boleta esta agregado el valor de deapcho debes descontarlo  <strong>
                </strong>
            </div>
        </div>

        <form action="{{ route('compras.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label for="numero_boleta" class="form-label">Número de Boleta *</label>
                <input type="text" name="numero_boleta" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="numero_orden_compra" class="form-label">Número de Orden de Compra</label>
                <input type="text" name="numero_orden_compra" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha *</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="compras_personales" class="form-label">Compras Personales ($)</label>
                <input type="number" step="0.01" name="compras_personales" class="form-control"
                    value="{{ old('compras_personales') }}" placeholder="0.00">
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select name="categoria" id="categoria" class="form-select">
                    <option value="">Seleccione categoría</option>
                    <option value="c" {{ old('categoria', $compra->categoria ?? '') == 'Capital' ? 'selected' : '' }}> C (capital)
                    </option>
                    <option value="g"
                        {{ old('categoria', $compra->categoria ?? '') == 'Ganancias' ? 'selected' : '' }}>G (Ganancias)
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="tienda" class="form-label">Tienda *</label>
                <input type="text" name="tienda" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="monto_comprado" class="form-label">Monto Comprado (SIN VALOR DE DESAPCHO) *</label>
                <input type="number" step="0.01" name="monto_comprado" class="form-control" required>
            </div>



            <div class="col-md-6">
                <label for="valor_despacho" class="form-label">Valor Despacho</label>
                <input type="number" step="0.01" name="valor_despacho" class="form-control">
            </div>

            <div class="col-md-12">
                <label for="archivo_boleta" class="form-label">Archivo Boleta (PDF/JPG/PNG)</label>
                <input type="file" name="archivo_boleta" class="form-control">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('compras.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
@endsection
