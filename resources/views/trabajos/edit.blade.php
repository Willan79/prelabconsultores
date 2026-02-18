{{--
|--------------------------------------------------------------------------
| Vista: Editar Trabajo
|--------------------------------------------------------------------------
| Descripción:
| Permite editar la información de un trabajo existente, incluyendo
| título, descripción, empresa asociada y gestión de imágenes.
|
| Funcionalidades:
| - Formulario de edición con validación.
| - Carga de múltiples imágenes.
| - Listado de imágenes actuales con opción de eliminación.
| - Mensajes de estado mediante componente <x-alerta>.
|
| Performance:
| - Imágenes con lazy loading.
| - Dimensiones máximas para evitar reflows.
|
| Dependencias:
| - Laravel Blade
| - Bootstrap 5
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@extends('layouts.app_admin')

@section('contenido')

    <section class="container magen-top" aria-labelledby="editar-trabajo-title">

        <header class="mb-4">
            <h2 id="editar-trabajo-title">Editar Trabajo</h2>
        </header>

        {{-- Mensajes --}}
        @if (session('success'))
            <x-alerta tipo="success" :mensaje="session('success')" />
        @endif

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        {{-- Formulario --}}
        <form action="{{ route('trabajos.update', $trabajo) }}" method="POST" enctype="multipart/form-data"
            class="shadow p-4 rounded mb-4">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="titulo" class="form-label">Título del trabajo</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required
                    value="{{ old('titulo', $trabajo->titulo) }}">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required>{{ old('descripcion', $trabajo->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="empresa_id" class="form-label">Empresa Cliente</label>
                <select name="empresa_id" id="empresa_id" class="form-select" required>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}"
                            {{ old('empresa_id', $trabajo->empresa_id) == $empresa->id ? 'selected' : '' }}>
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="imagens" class="form-label">
                    Imágenes del trabajo (puedes subir varias)
                </label>
                <input type="file" name="imagens[]" id="imagens" class="form-control" accept="image/*" multiple>
            </div>

            <footer class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    Actualizar
                </button>
                <a href="{{ route('trabajos.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </footer>
        </form>

        {{-- Imágenes actuales mensaje--}}
        @if ($trabajo->imagens && $trabajo->imagens->count() > 0)
            <section aria-labelledby="imagenes-actuales-title">
                <h3 id="imagenes-actuales-title" class="h5 mb-2">
                    Imágenes actuales
                </h3>

                <div class="d-flex flex-wrap gap-3">

                    @foreach ($trabajo->imagens as $imagen)
                        <figure class="position-relative">

                            <img src="{{ asset('storage/' . $imagen->ruta) }}" alt="Imagen del trabajo"
                                class="img-thumbnail" style="max-width:150px" loading="lazy" width="150" height="150">

                            <form action="{{ route('imagenes.destroy', $imagen) }}" method="POST"
                                class="position-absolute top-0 end-0" onsubmit="return confirm('¿Eliminar esta imagen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    ✖
                                </button>
                            </form>

                        </figure>
                    @endforeach

                </div>
            </section>
        @else
            <p class="text-muted">
                Este trabajo no tiene imágenes cargadas.
            </p>
        @endif

    </section>

@endsection
