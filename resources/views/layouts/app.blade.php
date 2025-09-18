@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Para compatibilidad con IE -->
    <title>Prelab consultores @yield('titulo')</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preload" href="{{ asset('img/inicio.webp') }}" as="image">

</head>

<body id="app">
    <div class="d-flex flex-column min-vh-100">
        <!-- HEADER -->
        <header class="shadow">
            <div class="container py-3">
                <div class="row align-items-center text-center text-md-start">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <img src="{{ asset('img/logo-21.png') }}" alt="Logo" class="img-fluid"
                            style="max-height: 60px;">
                    </div>
                    <div class="info-header col-6 col-md-4">
                        <h6 class="mb-0">Línea de Atención</h6>
                        <small>315 244 3063</small>
                    </div>
                    <div class="info-header col-6 col-md-4">
                        <h6 class="mb-0">Email</h6>
                        <small>comercial@prelabconsultores.com</small>
                    </div>
                </div>
            </div>
        </header>

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg shadow sticky-top">
            <div class="container">
                <div class="trabajos btn btn-outline-warning">
                    <a href="{{ route('trabajos.index') }}">Nuestros trabajos</a>
                </div>
                <!-- Botón para mostrar el menú en móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menuNavegacion">
                    <i class="bi bi-menu-up"></i>
                    <!-- <span class="navbar-toggler-icon"></span> -->
                </button>

                <div class="collapse navbar-collapse menu-overlay" id="menuNavegacion">

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
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link mt-2 text-decoration-none fw-bold"
                                        style="border: none; background: none; padding: 0; cursor: pointer;">
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
        <main class="flex-grow-1"> <!-- Hace que el main crezca para ocupar el espacio disponible -->
            @yield('contenido')
        </main>

        <footer class="footer mt-4">
            @yield('footer')
        </footer>

        @yield('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>


    </div>
</body>

</html>
