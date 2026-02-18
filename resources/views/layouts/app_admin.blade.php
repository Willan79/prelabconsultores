{{--
|--------------------------------------------------------------------------
| Layout del Panel Administrativo
|--------------------------------------------------------------------------
| Archivo: resources/views/layouts/app_admin.blade.php
|
| Descripción:
| Plantilla base para todas las vistas del panel de administración.
| Define la estructura general del dashboard: header fijo, navegación lateral
| responsive (desktop y mobile) y área de contenido principal.
|
| Funcionalidades:
| - Barra lateral fija en desktop.
| - Offcanvas lateral en mobile.
| - Navegación centralizada por módulos.
| - Logout seguro mediante POST + CSRF.
|
| Secciones Blade:
| - @yield('titulo'): título dinámico por módulo.
| - @yield('contenido'): contenido principal.
| - @yield('scripts'): scripts específicos por vista.
|
| Dependencias:
| - Laravel Blade
| - Bootstrap 5
| - Bootstrap Icons
| - Chart.js
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prelab Admin @yield('titulo')</title>

    {{-- SEO --}}
    <meta name="description" content="Panel administrativo Prelab Consultores">
    <meta name="author" content="Prelab Consultores">

    {{-- Estilos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app_admin.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    {{-- JS externos --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
</head>

<body>

    <!-- HEADER -->
    <header class="header-admin p-3 fixed-top w-100 shadow">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/FINAL.png') }}" alt="Logo Prelab" class="img-fluid rounded"
                style="max-height: 54px;">

            <h3 class="fw-bold flex-grow-1 text-center text-white">
                Panel Admin @yield('titulo')
            </h3>

            <button class="btn btn-outline-dark d-md-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-label="Mostrar menú">
                <i class="bi bi-list fs-3"></i>
            </button>
        </div>
    </header>

    <div class="d-flex min-vh-100 d-flex-column">

        <!--  BARRA LATERAL DE ESCRITORIO -->
        <nav class="barra-lateral bg-dark text-white p-3 d-none d-md-block col-md-3 col-lg-2 " aria-label="Menú lateral">
            <ul class="nav flex-column pt-4 gap-2">

                <li><a href="/" class="btn btn-outline-primary w-100">
                        <i class="bi bi-house-door-fill"></i> Inicio</a></li>

                <li><a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-speedometer2"></i> Panel</a></li>

                <li><a href="{{ route('tabla_empresas') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-buildings-fill"></i> Empresas</a></li>

                <li><a href="{{ route('auditorias') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-journal-check"></i> Auditorías</a></li>

                <li><a href="{{ route('tabla_user') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-people-fill"></i> Usuarios</a></li>

                <li><a href="{{ route('trabajos.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-file-earmark-font"></i> Trabajos</a></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- BARRA LATERAL MÓVIL -->
        <nav class="offcanvas offcanvas-start bg-dark text-white" id="sidebar" aria-label="Menú móvil">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menú</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Cerrar"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="nav flex-column gap-2">
                    <li><a href="/" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-house-door-fill"></i> Inicio</a></li>

                    <li><a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-speedometer2"></i> Panel</a></li>

                    <li><a href="{{ route('tabla_empresas') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-buildings-fill"></i> Empresas</a></li>

                    <li><a href="{{ route('auditorias') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-journal-check"></i> Auditorías</a></li>

                    <li><a href="{{ route('tabla_user') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-people-fill"></i> Usuarios</a></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- MAIN -->
        <main class="col-md-9 ms-sm-auto col-lg-10">
            @yield('contenido')
        </main>

    </div>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
</body>

</html>
