@extends('layouts.app')

{{--
|--------------------------------------------------------------------------
| Vista: Trabajos Realizados
|--------------------------------------------------------------------------
| Muestra una grilla de trabajos realizados por la empresa.
| Incluye:
| - Listado responsivo con Bootstrap
| - Carga diferida de imágenes
| - Acciones CRUD para usuarios admin
| - Mensajes de estado mediante componente <x-alerta>
|--------------------------------------------------------------------------
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@section('contenido')

    <section class="p-2 rounded" aria-labelledby="trabajos-title">

        <header class="text-center mb-4">
            <h1 id="trabajos-title" class="fw-bold text-muted">
                Trabajos Realizados
            </h1>

            <p class="text-muted fs-5">
                Explora los trabajos realizados para nuestros clientes y conoce más sobre nuestra experiencia.
            </p>
        </header>

        <hr>

        {{-- Botón visible solo para administradores --}}
        @if (auth()->check() && auth()->user()->role === 'admin')
            <div class="text-center mb-3">
                <a href="{{ route('trabajos.create') }}" class="btn btn-outline-primary">
                    Compartir nuevo trabajo
                </a>
            </div>
        @endif

        <x-alerta tipo="success" :mensaje="session('success')" />

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        @if ($trabajos->isEmpty())
            <p class="alert alert-info text-center">
                No hay trabajos registrados todavía.
            </p>
        @else
            {{-- Grilla principal de trabajos --}}
            <div class="row g-4">

                @foreach ($trabajos as $trabajo)
                    <article class="col-md-6 col-lg-4">

                        <div class="card h-100 shadow border-primary">

                            <figure class="mb-0">
                                @if ($trabajo->imagens->isNotEmpty())
                                    <img src="{{ asset('storage/' . $trabajo->imagens->first()->ruta) }}"
                                        class="card-img-top object-fit-cover" style="height:200px"
                                        alt="{{ $trabajo->titulo }}" loading="lazy" width="400" height="200">
                                @else
                                    <img src="{{ asset('img/img-trabajo.png') }}" class="card-img-top object-fit-cover"
                                        style="height:200px" alt="Trabajo sin imagen" loading="lazy" width="400"
                                        height="200">
                                @endif
                            </figure>

                            <div class="card-body text-center">
                                <h2 class="h5 card-title">
                                    {{ $trabajo->titulo }}
                                </h2>

                                <p class="card-text text-muted">
                                    {{ Str::limit($trabajo->descripcion, 100) }}
                                </p>

                                <p class="mb-1">
                                    <strong>Empresa:</strong>
                                    {{ $trabajo->empresa->nombre ?? 'N/A' }}
                                </p>

                                <time class="text-muted" datetime="{{ $trabajo->created_at->toDateString() }}">
                                    Realizado el {{ $trabajo->created_at->format('d/m/Y') }}
                                </time>
                            </div>

                            <footer class="card-footer bg-white text-end">

                                <a href="{{ route('trabajos.show', $trabajo) }}" class="btn btn-sm btn-outline-primary">
                                    Ver más
                                </a>

                                @if (auth()->check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('trabajos.edit', $trabajo) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        ✏️ Editar
                                    </a>

                                    <form action="{{ route('trabajos.destroy', $trabajo) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('¿Eliminar este trabajo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                @endif

                            </footer>

                        </div>
                    </article>
                @endforeach

            </div>
        @endif
    </section>

@endsection
