@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prelab consultores @yield('titulo')</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body id="app"> <!--  -->
    <div class="position-relative min-vh-100 "> <!-- Contenedor principal que ocupa toda la altura de la pantalla -->
        <!-- Navbar -->
        <header class="shadow">
            <div class="container py-3">
                <div class="row align-items-center text-center text-md-start">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <img src="{{ asset('img/logo-21.png') }}" alt="Logo" class="img-fluid" style="max-height: 60px;">
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

        <!-- MAIN -->
        <main class="flex-grow-1 py-4">
            <div class="container">
                @yield('contenido')
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="text-center text-white py-3">
            Copyright {{ now()->year }} © Todos los derechos Reservados | Prelabconsultores
        </footer>

        @yield('scripts')
    </div>
</body>

</html>
