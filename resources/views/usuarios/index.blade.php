@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-primary">Listado de Usuarios</h2>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-primary sticky-top" style="top: 0; z-index: 10;">
                <tr>
                    <th scope="col" class="text-nowrap">RUT</th>
                    <th scope="col" class="text-nowrap">Nombre</th>
                    <th scope="col" class="text-nowrap">Email</th>
                    <th scope="col" class="text-center text-nowrap">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $user)
                <tr>
                    <td class="text-nowrap">{{ $user->rut }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if ($user->rut !== '19266166-8')
                            <a href="{{ route('usuarios.edit-password', $user) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="Cambiar contraseña">
                                <i class="bi bi-key-fill"></i>
                                <span class="d-none d-md-inline"> Cambiar</span>
                            </a>
                        @else
                            <span class="text-muted fst-italic" title="No permitido">
                                <i class="bi bi-lock-fill"></i> No permitido Administrador
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
