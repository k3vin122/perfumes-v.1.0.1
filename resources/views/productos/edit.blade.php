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

        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data"
            class="row g-3 needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- SKU -->
            <div class="col-md-4">
                <label for="sku" class="form-label fw-semibold">SKU:</label>
                <input type="text" id="sku" name="sku" value="{{ old('sku', $producto->sku) }}"
                    class="form-control" readonly>
                <div class="invalid-feedback">Por favor ingresa el SKU.</div>
            </div>

            <!-- Marca -->
            <div class="col-md-4">
                <label for="marca" class="form-label fw-semibold">Marca:</label>
                <input type="text" id="marca" name="marca" value="{{ old('marca', $producto->marca) }}"
                    class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa la marca.</div>
            </div>

            <!-- Producto -->
            <div class="col-md-4">
                <label for="producto" class="form-label fw-semibold">Producto:</label>
                <input type="text" id="producto" name="producto" value="{{ old('producto', $producto->producto) }}"
                    class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa el nombre del producto.</div>
            </div>

            <!-- Género -->
            <div class="col-md-4">
                <label for="genero" class="form-label fw-semibold">Género:</label>
                <select id="genero" name="genero" class="form-select" required>
                    <option value="" disabled {{ old('genero', $producto->genero) ? '' : 'selected' }}>Seleccione...
                    </option>
                    <option value="Hombre" {{ old('genero', $producto->genero) == 'Hombre' ? 'selected' : '' }}>Hombre
                    </option>
                    <option value="Mujer" {{ old('genero', $producto->genero) == 'Mujer' ? 'selected' : '' }}>Mujer
                    </option>
                    <option value="Unisex" {{ old('genero', $producto->genero) == 'Unisex' ? 'selected' : '' }}>Unisex
                    </option>
                </select>
                <div class="invalid-feedback">Por favor selecciona un género.</div>
            </div>

            <!-- Notas -->
            <div class="col-md-8">
                <label for="notas" class="form-label fw-semibold">Notas:</label>
                <textarea name="notas" id="notas" rows="3" class="form-control">{{ old('notas', $producto->notas) }}</textarea>
            </div>

            <!-- Valor Compra -->
            <div class="col-md-3">
                <label for="valor_compra" class="form-label fw-semibold">Valor Compra:</label>
                <input type="number" step="0.01" id="valor_compra" name="valor_compra"
                    value="{{ old('valor_compra', $producto->valor_compra) }}" class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa el valor de compra.</div>
            </div>

            <!-- Cantidad -->
            <div class="col-md-3">
                <label for="cantidad" class="form-label fw-semibold">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad', $producto->cantidad) }}"
                    class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa la cantidad.</div>
            </div>

            <!-- Valor Venta Sur -->
            <div class="col-md-3">
                <label for="valor_venta_sur" class="form-label fw-semibold">Valor Venta Sur:</label>
                <input type="number" step="0.01" id="valor_venta_sur" name="valor_venta_sur"
                    value="{{ old('valor_venta_sur', $producto->valor_venta_sur) }}" class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa el valor de venta sur.</div>
            </div>

            <!-- Valor Venta Norte -->
            <div class="col-md-3">
                <label for="valor_venta_norte" class="form-label fw-semibold">Valor Venta Norte:</label>
                <input type="number" step="0.01" id="valor_venta_norte" name="valor_venta_norte"
                    value="{{ old('valor_venta_norte', $producto->valor_venta_norte) }}" class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa el valor de venta norte.</div>
            </div>

            <!-- Sucursal -->
            <div class="col-md-6">
                <label for="sucursal" class="form-label fw-semibold">Sucursal:</label>
                <select name="sucursal" id="sucursal" class="form-select" required>
                    <option value="" disabled {{ old('sucursal', $producto->sucursal) ? '' : 'selected' }}>
                        Seleccione...</option>
                    <option value="Rancagua" {{ old('sucursal', $producto->sucursal) == 'Rancagua' ? 'selected' : '' }}>
                        Rancagua</option>
                    <option value="Puerto Varas"
                        {{ old('sucursal', $producto->sucursal) == 'Puerto Varas' ? 'selected' : '' }}>Puerto Varas
                    </option>
                </select>
                <div class="invalid-feedback">Por favor selecciona una sucursal.</div>
            </div>

            <!-- Imagen Actual -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Imagen Actual:</label><br>
                @if ($producto->imagen)
                    <div class="img-wrapper">
                        <div class="img-container">
                            <img src="{{ url('archivos/' . $producto->imagen) }}" alt="Imagen" />
                        </div>
                    </div>
                @else
                    <span class="text-muted fst-italic">Sin imagen</span>
                @endif
            </div>

            <!-- Nueva Imagen -->
            <div class="col-md-12">
                <label for="imagen" class="form-label fw-semibold">Nueva Imagen (100x100):</label>
                <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
            </div>

            <!-- Botones -->
            <div class="col-12 d-flex justify-content-between mt-3">
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                <button type="submit" class="btn btn-primary px-5 fw-semibold">Actualizar</button>
            </div>
        </form>

        <script>
            // Ejemplo simple de validación Bootstrap 5
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
            })()
        </script>

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
