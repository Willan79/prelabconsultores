@props(['tipo' => 'success', 'mensaje' => null]) {{-- success, danger, warning, info --}}

@if ($mensaje)
    <div id="alerta-{{ $tipo }}"
         class="alert alert-{{ $tipo }} mt-2">
        {{ $mensaje }}
    </div>

    <script>
        setTimeout(() => {
            let alerta = document.getElementById('alerta-{{ $tipo }}');
            if (alerta) {
                alerta.style.transition = "opacity 0.5s ease";
                alerta.style.opacity = "0";
                setTimeout(() => alerta.remove(), 500);
            }
        }, 3000);
    </script>
@endif

{{--
Ejecuta en tu proyecto:
php artisan make:component Alerta
Esto te crea:
app/View/Components/Alerta.php
resources/views/components/alerta.blade.php
--}}

{{-- Componente de alerta personalizado en las vistas:
        @if (session('success'))
            <x-alerta tipo="success" :mensaje="session('success')" />
        @endif

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif
--}}

