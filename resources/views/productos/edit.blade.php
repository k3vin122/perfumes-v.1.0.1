@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 700px;">
    <h1 class="mb-4 fw-bold text-center text-primary">Editar Producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong>¡Ups!</strong> Corrige los errores:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <!-- SKU -->
        <div class="mb-3">
            <label for="sku" class="form-label fw-semibold">SKU:</label>
            <input type="text" id="sku" name="sku" value="{{ old('sku', $producto->sku) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Marca -->
        <div class="mb-3">
            <label for="marca" class="form-label fw-semibold">Marca:</label>
            <input type="text" id="marca" name="marca" value="{{ old('marca', $producto->marca) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Producto -->
        <div class="mb-3">
            <label for="producto" class="form-label fw-semibold">Producto:</label>
            <input type="text" id="producto" name="producto" value="{{ old('producto', $producto->producto) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Género -->
        <div class="mb-3">
            <label for="genero" class="form-label fw-semibold">Género:</label>
            <select id="genero" name="genero" class="form-select form-select-lg" required>
                <option value="Hombre" {{ old('genero', $producto->genero) == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                <option value="Mujer" {{ old('genero', $producto->genero) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                <option value="Unisex" {{ old('genero', $producto->genero) == 'Unisex' ? 'selected' : '' }}>Unisex</option>
            </select>
        </div>

        <!-- Notas -->
        <div class="mb-3">
            <label for="notas" class="form-label fw-semibold">Notas:</label>
            <textarea name="notas" id="notas" rows="4" class="form-control form-control-lg">{{ old('notas', $producto->notas) }}</textarea>
        </div>

        <!-- Valor Compra -->
        <div class="mb-3">
            <label for="valor_compra" class="form-label fw-semibold">Valor Compra:</label>
            <input type="number" step="0.01" id="valor_compra" name="valor_compra" value="{{ old('valor_compra', $producto->valor_compra) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Cantidad -->
        <div class="mb-3">
            <label for="cantidad" class="form-label fw-semibold">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad', $producto->cantidad) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Valor Venta Sur -->
        <div class="mb-3">
            <label for="valor_venta_sur" class="form-label fw-semibold">Valor Venta Sur:</label>
            <input type="number" step="0.01" id="valor_venta_sur" name="valor_venta_sur" value="{{ old('valor_venta_sur', $producto->valor_venta_sur) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Valor Venta Norte -->
        <div class="mb-3">
            <label for="valor_venta_norte" class="form-label fw-semibold">Valor Venta Norte:</label>
            <input type="number" step="0.01" id="valor_venta_norte" name="valor_venta_norte" value="{{ old('valor_venta_norte', $producto->valor_venta_norte) }}" class="form-control form-control-lg" required>
        </div>

        <!-- Sucursal -->
        <div class="mb-3">
            <label for="sucursal" class="form-label fw-semibold">Sucursal:</label>
            <select name="sucursal" id="sucursal" class="form-select form-select-lg" required>
                <option value="Rancagua" {{ old('sucursal', $producto->sucursal) == 'Rancagua' ? 'selected' : '' }}>Rancagua</option>
                <option value="Puerto Varas" {{ old('sucursal', $producto->sucursal) == 'Puerto Varas' ? 'selected' : '' }}>Puerto Varas</option>
            </select>
        </div>

        <!-- Imagen Actual -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Imagen Actual:</label><br>
            @if ($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" width="120" class="rounded shadow-sm mb-2" alt="Imagen actual del producto">
            @else
                <span class="text-muted">Sin imagen</span>
            @endif
        </div>

        <!-- Nueva Imagen -->
        <div class="mb-4">
            <label for="imagen" class="form-label fw-semibold">Nueva Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control form-control-lg" accept="image/*">
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancelar</a>
            <button type="submit" class="btn btn-primary btn-lg px-5 fw-semibold">Actualizar</button>
        </div>
    </form>
</div>

<script>
    // Bootstrap validation (optional)
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();
</script>
@endsection
