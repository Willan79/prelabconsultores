@extends('layouts.app')

@section('contenido')

    @if ($trabajo->imagens->isNotEmpty())
        {{-- Verificar si hay imágenes --}}

        <div class="container my-5">
            @if (session('success'))
                <x-alerta tipo="success" :mensaje="session('success')" />
            @endif

            @if ($errors->any())
                <x-alerta tipo="danger" :mensaje="$errors->first()" />
            @endif
            <h2 class="mb-4">{{ $trabajo->titulo }}</h2>
            <p class="mb-3">{{ $trabajo->descripcion }}</p>
            <p><strong>Empresa:</strong> {{ $trabajo->empresa->nombre }}</p>

            <div id="carouselTrabajo" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($trabajo->imagens as $key => $imagen)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}"> {{-- Activar la primera imagen --}}
                            <img src="{{ asset('storage/' . $imagen->ruta) }}" class="d-block mx-auto rounded img-carousel"
                                alt="{{ $trabajo->titulo }}">
                        </div>
                    @endforeach
                </div>

                {{-- Controles --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTrabajo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselTrabajo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
            <a href="{{ route('trabajos.index') }}" class="btn btn-secondary">Volver</a>
            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('trabajos.edit', $trabajo->id) }}" class="btn btn-primary">Editar</a>
            @endif
        </div>
    @else
        <div class="container my-5">
            <div>
                <div class="alert alert-info">
                    <strong>Nota:</strong> Este trabajo no tiene imágenes asociadas.
                </div>
            </div>
            <h2 class="mb-4">{{ $trabajo->titulo }}</h2>
            <p class="mb-3">{{ $trabajo->descripcion }}</p>
            <p><strong>Empresa:</strong> {{ $trabajo->empresa->nombre }}</p>

            <a href="{{ route('trabajos.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('trabajos.edit', $trabajo->id) }}" class="btn btn-primary">Editar</a>
        </div>
    @endif
@endsection
