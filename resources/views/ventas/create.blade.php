@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">
        <i class="bi bi-cart-plus-fill text-primary"></i> Registrar Venta
    </h1>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <!-- Zona -->
        <div class="mb-3">
            <label class="form-label fw-semibold">
                <i class="bi bi-geo-alt-fill me-1"></i> Zona
            </label>
            <select name="zona" class="form-select">
                <option value="Sur">Sur</option>
                <option value="Norte">Norte</option>
            </select>
            @error('zona')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Productos -->
        <div id="productos-container">
            <div class="producto-item border rounded p-3 mb-3">
                <!-- Producto -->
                <div class="mb-2">
                    <label class="form-label">Producto</label>
                    <select name="productos[0][producto_id]" class="form-select">
                        <option value="">Selecciona un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">
                                {{ $producto->sku }} - {{ $producto->producto }} (Stock: {{ $producto->cantidad }})
                            </option>
                        @endforeach
                    </select>
                    @error('productos.0.producto_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Cantidad -->
                <div class="mb-2">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="productos[0][cantidad_vendida]" class="form-control" min="1"
                        placeholder="Ej: 1">
                    @error('productos.0.cantidad_vendida')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botón eliminar -->
                <button type="button" class="btn btn-danger btn-remove-producto">
                    <i class="bi bi-trash"></i> Eliminar producto
                </button>
            </div>
        </div>

        <!-- Botón agregar producto -->
        <button type="button" id="add-producto" class="btn btn-secondary mb-3">
            <i class="bi bi-plus-circle"></i> Agregar otro producto
        </button>

        <!-- Submit -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-cart-check-fill"></i> Registrar Venta
            </button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        let index = 1;

        $('#add-producto').on('click', function () {
            const $container = $('#productos-container');
            const $original = $container.find('.producto-item').first();
            const $clone = $original.clone();

            // Limpiar valores
            $clone.find('select').val('');
            $clone.find('input').val('');

            // Actualizar los índices de nombres
            $clone.find('select').attr('name', `productos[${index}][producto_id]`);
            $clone.find('input').attr('name', `productos[${index}][cantidad_vendida]`);

            $container.append($clone);
            index++;
        });

        // Asegurar que cualquier botón eliminar funcione (viejos y nuevos)
        $(document).on('click', '.btn-remove-producto', function () {
            const items = $('.producto-item');
            if (items.length > 1) {
                $(this).closest('.producto-item').remove();
            } else {
                alert('Debe haber al menos un producto.');
            }
        });
    });
</script>
@endpush
