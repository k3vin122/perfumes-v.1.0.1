<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <!-- Aquí puedes poner tu logo -->
            <img src="{{ asset('botella-de-perfume.png') }}" alt="Logo" style="height: 40px; width: auto;" class="me-2">
            <span class="text-warning">K&C</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                 <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('stockCliente.index') ? 'active' : '' }}"
                        href="{{ route('stockCliente.index') }}">Stock Cliente</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('productos.index') ? 'active' : '' }}"
                        href="{{ route('productos.index') }}">Stock</a>
                </li>


                
                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('ventas_credito.index') ? 'active' : '' }}"
                        href="{{ route('ventas_credito.index') }}">Ventas Crédito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('ventas.index') ? 'active' : '' }}"
                        href="{{ route('ventas.index') }}">Ventas Efectivo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('usuarios.index') ? 'active' : '' }}"
                        href="{{ route('usuarios.index') }}">Gestión de Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('perfumes.index') ? 'active' : '' }}"
                        href="{{ route('perfumes.index') }}">Futuros Perfumes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('compras.*') ? 'active' : '' }}"
                        href="{{ route('compras.index') }}">Logistica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light {{ request()->routeIs('compras.*') ? 'active' : '' }}"
                        href="{{ route('dinerobanco.index') }}">Banco</a>
                </li>
            </ul>

            <!-- User dropdown -->
            <div class="dropdown">
                @auth
                    <a class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    </ul>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Cerrar sesión</button>
                    </form>
                @else
                    <a class="nav-link text-warning" href="{{ route('login') }}">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
