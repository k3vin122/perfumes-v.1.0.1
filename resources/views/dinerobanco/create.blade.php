@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Crear Nuevo Registro</h1>

        <!-- Botón Volver -->
        <a href="{{ route('dinerobanco.index') }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Volver a la lista
        </a>

        <!-- Formulario de creación de registro -->
        <form action="{{ route('dinerobanco.store') }}" method="POST">
            @csrf
            <div class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label for="dinero" class="form-label">Dinero</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="dinero" 
                            id="dinero" 
                            class="form-control" 
                            required 
                            aria-label="Monto de dinero"
                            placeholder="Introduce la cantidad de dinero"
                        >
                    </div>
                    @error('dinero')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-save"></i> Crear Registro
                </button>
            </div>
        </form>
    </div>
@endsection
