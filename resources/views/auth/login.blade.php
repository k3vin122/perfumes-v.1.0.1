<x-guest-layout>

    <!-- Enlace al archivo CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-gradient" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px; background-color: #ffffff;">

            <!-- Logo (opcional, descomentar si quieres usarlo) -->
            <!-- <div class="d-flex justify-content-center mb-4">
                <img src="{{ asset('storage/logo_empresa_header.png') }}" alt="Logo Perfumes" class="h-24 w-auto" />
            </div> -->

            <h2 class="text-center mb-3" style="font-size: 2.25rem; font-weight: 700; color: #333;">Iniciar sesión</h2>
            <p class="text-center text-muted mb-4">Ingresa con tu cuenta para continuar</p>

            <!-- Mensajes de estado -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Formulario de inicio de sesión -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="rut" class="form-label">RUT</label>
                    <input id="rut" name="rut" type="text" required autofocus
                        placeholder="Ejemplo: 12.345.678-9"
                        class="form-control @error('rut') is-invalid @enderror">
                    @error('rut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" name="password" type="password" required
                        placeholder="********"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input id="remember_me" name="remember" type="checkbox" class="form-check-input">
                        <label for="remember_me" class="form-check-label">Recordarme</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-decoration-none text-primary">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2" style="font-weight: 600; border-radius: 50px;">
                    Ingresar
                </button>
            </form>

          

        </div>
    </div>

    <!-- Enlace al archivo JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
