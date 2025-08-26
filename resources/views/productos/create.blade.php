@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 700px;">
    <!-- Card para el formulario -->
    <div class="card shadow-lg p-4">
        <h1 class="mb-4 fw-bold text-center text-primary">Crear Producto</h1>

        <!-- Mensajes de éxito y error -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <strong>¡Ups!</strong> Hay algunos errores:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
            @csrf

            <!-- SKU -->
            <div class="col-md-6">
                <label for="sku" class="form-label fw-semibold">SKU:</label>
             
<p><mark>  El SKU del Producto se genera de manera automática.</mark></p>


            </div>

            <!-- Marca -->
            <div class="col-md-6">
                <label for="marca" class="form-label fw-semibold">Marca:</label>
                <input type="text" id="marca" name="marca" value="{{ old('marca') }}" class="form-control form-control-lg" required>
                @error('marca')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Producto -->
            <div class="col-md-6">
                <label for="producto" class="form-label fw-semibold">Producto:</label>
                <input type="text" id="producto" name="producto" value="{{ old('producto') }}" class="form-control form-control-lg" required>
                @error('producto')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cantidad -->
            <div class="col-md-6">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" step="0.01" name="cantidad" class="form-control form-control-lg" required>
            </div>

            <!-- Género -->
            <div class="col-md-6">
                <label for="genero" class="form-label fw-semibold">Género:</label>
                <select id="genero" name="genero" class="form-select form-select-lg" required>
                    <option value="" disabled {{ old('genero') ? '' : 'selected' }}>Selecciona</option>
                    <option value="Hombre" {{ old('genero') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="Mujer" {{ old('genero') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    <option value="Unisex" {{ old('genero') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                </select>
                @error('genero')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Valor Compra -->
            <div class="col-md-4">
                <label for="valor_compra" class="form-label fw-semibold">Valor Compra:</label>
                <input type="number" step="0.01" id="valor_compra" name="valor_compra" value="{{ old('valor_compra') }}" class="form-control form-control-lg" required>
                @error('valor_compra')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Valor Venta Sur -->
            <div class="col-md-4">
                <label for="valor_venta_sur" class="form-label fw-semibold">Valor Venta Sur:</label>
                <input type="number" step="0.01" id="valor_venta_sur" name="valor_venta_sur" value="{{ old('valor_venta_sur') }}" class="form-control form-control-lg" required>
                @error('valor_venta_sur')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Valor Venta Norte -->
            <div class="col-md-4">
                <label for="valor_venta_norte" class="form-label fw-semibold">Valor Venta Norte:</label>
                <input type="number" step="0.01" id="valor_venta_norte" name="valor_venta_norte" value="{{ old('valor_venta_norte') }}" class="form-control form-control-lg" required>
                @error('valor_venta_norte')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sucursal -->
            <div class="col-md-8">
                <label for="sucursal" class="form-label fw-semibold">Sucursal:</label>
                <select name="sucursal" id="sucursal" class="form-select form-select-lg" required>
                    <option value="" disabled {{ old('sucursal') ? '' : 'selected' }}>Selecciona una sucursal</option>
                    <option value="Rancagua" {{ old('sucursal') == 'Rancagua' ? 'selected' : '' }}>Rancagua</option>
                    <option value="Puerto Varas" {{ old('sucursal') == 'Puerto Varas' ? 'selected' : '' }}>Puerto Varas</option>
                </select>
            </div>

            <!-- Notas -->
            <div class="col-md-12">
                <label for="notas" class="form-label fw-semibold">Notas:</label>
                <textarea name="notas" id="notas" rows="4" class="form-control form-control-lg">{{ old('notas') }}</textarea>
                @error('notas')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Imagen -->
            <div class="col-12">
                <label for="imagen" class="form-label fw-semibold">Imagen:</label>
                <input type="file" id="imagen" name="imagen" class="form-control form-control-lg" accept="image/*">
                @error('imagen')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="col-12 mt-4 d-flex justify-content-between">
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-lg px-5 fw-semibold">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<script>
// Bootstrap form validation example (optional)
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>
@endsection