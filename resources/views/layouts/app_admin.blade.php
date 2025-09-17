@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Para compatibilidad con IE -->
    <title>Prelab Admin @yield('titulo')</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app_admin.css') }}">
</head>

<body>
    <header class="header-admin p-3 fixed-top w-100 z-50 shadow">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="header-tex text-center fw-bold flex-grow-1 ">Panel admin @yield('titulo')</h3>
            <!-- Botón para mostrar el menú en móviles -->
            <button class="btn btn-outline-dark d-md-none me-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </header>

    <div class="d-flex min-vh-100 ">
        <!-- Barra lateral fija en pantallas grandes -->
        <nav class="nav-lateral bg-dark text-white p-3 d-none d-md-block col-md-3 col-lg-2 vh-100">
            <ul class=" nav flex-column pt-5">
                <li class="nav-item mb-2">
                    <a href="/" class="btn btn-outline-primary w-100"><i class="bi bi-house-door-fill">
                        </i> Inicio
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-speedometer2"></i> Panel
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('tabla_empresas') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-buildings-fill"></i> Empresas
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('auditorias') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-journal-check"></i> Auditorías
                    </a>
                </li>
                
                <li class="nav-item mb-2">
                    <a href="{{ route('tabla_user') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-people-fill"></i> Usuarios
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('trabajos.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-people-fill"></i> Trabajos
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Barra lateral en móviles -->
        <nav class="offcanvas offcanvas-start bg-dark text-white" id="sidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menú</h5>
                <button type="button" class="btn-close  text-reset " data-bs-dismiss="offcanvas">
                    <i class="bi bi-x-circle text-danger "></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="/" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-house-door-fill"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-speedometer2"></i> Panel
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('tabla_empresas') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-duffle"></i> Empresas
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('auditorias') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-bag-fill"></i> Auditorías
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('tabla_user') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-people-fill"></i> Usuarios
                        </a>
                    </li>

                    <li class="nav-item mb-2">
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

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 ">

            @yield('contenido')

        </main>
        @yield('scripts') <!-- Aquí se insertarán los scripts de cada vista -->
        <!-- Bootstrap JS (necesario para el menú lateral en móviles) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer>
        </script>
    </div>


</body>

</html>
