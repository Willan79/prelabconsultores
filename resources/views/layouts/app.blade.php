{{--
|--------------------------------------------------------------------------
| Layout principal de la aplicación
|--------------------------------------------------------------------------
| Archivo: resources/views/layouts/app.blade.php
|
| Descripción:
| Plantilla base del sistema que define la estructura HTML global:
| header, navbar, contenido dinámico y footer.
|
| Funciones:
| - Carga de assets mediante Vite.
| - Integración con Bootstrap 5 y Bootstrap Icons.
| - Navbar dinámica según rol del usuario.
| - Estructura responsive.
|
| Secciones Blade:
| - @yield('titulo'): título dinámico de la página.
| - @yield('contenido'): contenido principal.
| - @yield('footer'): pie de página.
| - @yield('scripts'): scripts específicos por vista.
|
| Dependencias:
| - Laravel Blade
| - Bootstrap 5
| - Vite
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
    <title>Prelab Consultores @yield('titulo')</title>

    {{-- SEO --}}
    <meta name="description" content="Prelab Consultores - Gestión de trabajos y clientes">
    <meta name="author" content="Prelab Consultores">

    {{-- Estilos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Recursos --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preload" href="{{ asset('img/inicio.webp') }}" as="image">

    {{-- JS externos --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
</head>

<body id="app">

    <div class="d-flex flex-column min-vh-100">

        <!-- HEADER -->
        <header class="shadow">
            <div class="container py-3">
                <div class="row align-items-center text-center text-md-start">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <img src="{{ asset('img/logo-21.png') }}" alt="Logo Prelab Consultores" class="img-fluid"
                            style="max-height: 60px;">
                    </div>

                    <div class="col-6 col-md-4">
                        <h6 class="mb-0">Línea de Atención</h6>
                        <small>315 244 3063</small>
                    </div>

                    <div class="col-6 col-md-4">
                        <h6 class="mb-0">Email</h6>
                        <small>comercial@prelabconsultores.com</small>
                    </div>
                </div>
            </div>
        </header>

        <!-- NAV -->
        <nav class="navbar navbar-expand-lg shadow sticky-top" aria-label="Navegación principal">
            <div class="container">

                <a href="{{ route('trabajos.index') }}" class="btn btn-outline-warning">
                    Nuestros trabajos
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacion"
                    aria-controls="menuNavegacion" aria-expanded="false" aria-label="Mostrar menú">
                    <i class="bi bi-list fs-3"></i>
                </button>

                <div class="collapse navbar-collapse" id="menuNavegacion">
                    <ul class="navbar-nav ms-auto fw-bold">

                        @auth
                            <li class="nav-item">
                                <a href="/" class="nav-link">Inicio</a>
                            </li>

                            @if (auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link">Admin</a>
                                </li>
                            @endif

                            @if (auth()->user()->role === 'cliente')
                                <li class="nav-item">
                                    <a href="{{ route('empresa.cliente') }}" class="nav-link">Mi Empresa</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link text-danger">
                                        Salir
                                    </button>
                                </form>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a href="/" class="nav-link">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Registro</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <!-- MAIN -->
        <main class="flex-grow-1">
            @yield('contenido')
        </main>

        <!-- FOOTER -->
        <footer class="mt-4">
            @yield('footer')
        </footer>

    </div>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

</body>

</html>
