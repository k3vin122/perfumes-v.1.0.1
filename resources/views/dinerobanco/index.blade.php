@extends('layouts.app') <!-- Si usas una plantilla principal -->

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Registros de Dinero en Banco</h1>

        <!-- Botón para crear nuevo registro -->
        <a href="{{ route('dinerobanco.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Crear nuevo registro
        </a>

        <!-- Botón Llamativo -->
        <a href="https://login.portales.bancochile.cl/login?state=hKFo2SBoUWRLdTNJRGlaaTk4OGRsTmJHQS1lekkwakR6c3k4b6FupWxvZ2luo3RpZNkgZGlQWUQwVHNfcHE4S0c4V2tDNE9Nc0VkS1hPX1BZaDmjY2lk2SBmUDdKVmRvcGV2VGFvZmJYcmZrMUZUZW9sVTVYTDE2NQ&client=fP7JVdopevTaofbXrfk1FTeolU5XL165&protocol=oauth2&response_type=code&scope=openid%20email%20profile&redirect_uri=https%3A%2F%2Fportalpersonas.bancochile.cl%3A443%2Fmibancochile-web%2Fredirect_uri&nonce=jrvRfTufOalIcycBXPArp_-c2lmqOosT58k9OpvVkZQ" 
            class="btn btn-danger btn-lg mb-3" target="_blank">
            <i class="bi bi-shield-lock"></i> Acceder a Banco Chile
        </a>

        <!-- Tabla de registros -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Dinero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dinerobanco as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>${{ number_format($registro->dinero, 2) }}</td>
                            <td class="d-flex">
                                <!-- Botón Ver -->
                                <a href="{{ route('dinerobanco.show', $registro->id) }}" class="btn btn-info me-2" role="button">
                                    <i class="bi bi-eye"></i> Ver
                                </a>

                                <!-- Botón Editar -->
                                <a href="{{ route('dinerobanco.edit', $registro->id) }}" class="btn btn-warning me-2" role="button">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>

                                <!-- Formulario Eliminar -->
                                <form action="{{ route('dinerobanco.destroy', $registro->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
