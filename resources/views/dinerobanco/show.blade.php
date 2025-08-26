@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Detalles del Registro</h1>

        <!-- Botón Volver -->
        <a href="{{ route('dinerobanco.index') }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Volver al listado
        </a>

        <!-- Tarjeta con detalles del registro -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">
                    <strong>ID:</strong> {{ $dinerobanco->id }}
                </h5>
                <p class="card-text">
                    <strong>Dinero:</strong> ${{ number_format($dinerobanco->dinero, 2) }}
                </p>
            </div>
        </div>
    </div>
@endsection