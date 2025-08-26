@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 400px; margin-top: 2rem;">
    <h2 class="mb-4">Cambiar contraseña de {{ $user->name }}</h2>

    @if(session('error'))
        <div class="alert alert-danger py-2 px-3">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success py-2 px-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('usuarios.update-password', $user) }}" method="POST" novalidate>
        @csrf

        <label for="password" class="form-label">Nueva contraseña</label>
        <input type="password" name="password" id="password" class="form-control mb-3" required>
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mb-4" required>

        <button type="submit" class="btn btn-primary w-100">Actualizar contraseña</button>
    </form>
</div>
@endsection
