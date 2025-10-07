@extends('layouts.app')

@section('contenido')
    <div class="p-2 rounded">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <h1 class="fw-bold text-muted ">Trabajos Realizados</h1>
        </div>
        <p class="text-center text-muted fs-5">Explora los trabajos realizados para nuestros clientes y conoce más sobre
            nuestra
            experiencia.</p>
        <hr class="mb-4">
        @if (auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('trabajos.create') }}" class="btn btn-outline-primary mb-3">Comparte un nuevo trabajo</a>
        @endif
        
        {{-- Desde resources/views/components/alerta.blade.php --}}
        <x-alerta tipo="success" :mensaje="session('success')" />

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        {{-- Verificar si no hay trabajos --}}
        @if ($trabajos->isEmpty())
            <div class="alert alert-info text-center">
                No hay trabajos registrados todavía.
            </div>
        @else
            <div class=" text-center">
                <div class="row">
                    @foreach ($trabajos as $trabajo)
                        <div class=" col-md-6 col-lg-4 ">
                            <div class="card mb-4 shadow-lg border-primary">
                                {{-- Imagen del trabajo --}}
                                @if ($trabajo->imagens->isNotEmpty())
                                    {{-- Mostrar solo la primera imagen --}}
                                    <img src="{{ asset('storage/' . $trabajo->imagens->first()->ruta) }}"
                                        class="card-img-top object-fit-cover" style="height:200px;" alt="{{ $trabajo->titulo }}">
                                @else
                                    {{-- Si no hay imágenes, mostrar una imagen por defecto --}}
                                    <img class="img-fluid" src="{{ asset('img/img-trabajo.png') }}" class="card-img-top"
                                        alt="Sin imagen">
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $trabajo->titulo }}</h5>
                                    <p class="card-text text-muted">
                                        {{ Str::limit($trabajo->descripcion, 100) }} {{-- Limitar la descripción a 100 caracteres --}}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Empresa:</strong>
                                        {{ $trabajo->empresa->nombre ?? 'N/A' }}
                                    </p>
                                    <small class="text-muted">
                                        Realizado el {{ $trabajo->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                                <div class="card-footer bg-white text-end">
                                    <a href="{{ route('trabajos.show', $trabajo->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Ver más
                                    </a>

                                    @if (auth()->check() && auth()->user()->role === 'admin')
                                        <a href="{{ route('trabajos.edit', $trabajo) }}"
                                            class="btn btn-sm btn-outline-warning">✏️
                                            Editar</a>

                                        <form action="{{ route('trabajos.destroy', $trabajo->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este trabajo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">🗑️
                                                Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
