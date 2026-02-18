{{--
|--------------------------------------------------------------------------
| Vista: Detalle de Trabajo
|--------------------------------------------------------------------------
| Descripción:
| Muestra la información detallada de un trabajo realizado por la empresa,
| incluyendo título, descripción, empresa asociada y una galería de imágenes.
|
| Funcionalidades:
| - Visualización de datos principales del trabajo.
| - Carrusel de imágenes con Bootstrap si existen imágenes asociadas.
| - Mensajes de estado usando el componente <x-alerta>.
| - Botón de edición visible solo para usuarios con rol administrador.
|
| Performance:
| - Primera imagen con carga inmediata (eager).
| - Imágenes restantes con carga diferida (lazy loading).
| - Dimensiones fijas para evitar saltos de layout (CLS).
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}


@extends('layouts.app')

@section('contenido')

    <section class="container my-5 col-lg-8" aria-labelledby="trabajo-title">

        {{-- Mensajes --}}
        @if (session('success'))
            <x-alerta tipo="success" :mensaje="session('success')" />
        @endif

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        {{-- Encabezado --}}
        <header class="mb-4">
            <h2 id="trabajo-title">{{ $trabajo->titulo }}</h2>
            <p>{{ $trabajo->descripcion }}</p>
            <p><strong>Empresa:</strong> {{ $trabajo->empresa->nombre }}</p>
        </header>

        {{-- Galería --}}
        @if ($trabajo->imagens->isNotEmpty())
            <figure>

                <div id="carouselTrabajo" class="carousel slide mb-4 shadow" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @foreach ($trabajo->imagens as $key => $imagen)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $imagen->ruta) }}"
                                    class="d-block mx-auto rounded object-fit-cover" style="height:300px"
                                    alt="{{ $trabajo->titulo }}" loading="{{ $key === 0 ? 'eager' : 'lazy' }}"
                                    width="600" height="300">
                            </div>
                        @endforeach

                    </div>

                    {{-- Controles accesibles --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTrabajo"
                        data-bs-slide="prev" aria-label="Imagen anterior">
                        <i class="bi bi-arrow-left-circle fs-2 text-secondary"></i>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTrabajo"
                        data-bs-slide="next" aria-label="Imagen siguiente">
                        <i class="bi bi-arrow-right-circle fs-2 text-secondary"></i>
                    </button>
                </div>

                <figcaption class="text-muted text-center">
                    Galería de imágenes del trabajo
                </figcaption>

            </figure>
        @else
            <p class="alert alert-info">
                Este trabajo no tiene imágenes asociadas.
            </p>
        @endif

        {{-- Acciones --}}
        <footer class="mt-4">
            <a href="{{ route('trabajos.index') }}" class="btn btn-secondary">
                Volver
            </a>

            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('trabajos.edit', $trabajo) }}" class="btn btn-primary">
                    Editar
                </a>
            @endif
        </footer>

    </section>

@endsection
