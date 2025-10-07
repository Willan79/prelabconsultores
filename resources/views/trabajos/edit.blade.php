@extends('layouts.app')

@section('contenido')
    <div class="container magen-top-admin my-5">
        <h2>Editar Trabajo</h2>
        @if (session('success'))
            <x-alerta tipo="success" :mensaje="session('success')" />
        @endif

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        {{-- Formulario para editar el trabajo --}}
        <form action="{{ route('trabajos.update', $trabajo->id) }}" method="POST" enctype="multipart/form-data"
            class="shadow p-4 rounded">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="titulo" class="form-label">Título del trabajo</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required
                    value="{{ old('titulo', $trabajo->titulo) }}">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="2" class="form-control" required>{{ old('descripcion', $trabajo->descripcion) }}</textarea>
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
                <label for="imagens" class="form-label">Imágenes del trabajo (puedes subir varias)</label>
                <input type="file" name="imagens[]" id="imagens" class="form-control" accept="image/*" multiple>

            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('trabajos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
        {{-- Mostrar imágenes actuales con opción para eliminar --}}
        @if ($trabajo->imagens && $trabajo->imagens->count() > 0)
            {{-- Verificar si hay imágenes --}}
            <p class="mt-2">Imágenes actuales:</p>
            <div class="d-flex flex-wrap gap-2">
                {{-- Iterar sobre las imágenes del trabajo --}}
                @foreach ($trabajo->imagens as $imagen)
                    <div class="position-relative d-inline-block">
                        {{-- -- Contenedor para cada imagen --}}
                        <img src="{{ asset('storage/' . $imagen->ruta) }}" alt="Imagen del trabajo" class="img-thumbnail"
                            style="max-width: 150px;"> 

                        {{-- Botón para eliminar --}}
                        <form action="{{ route('imagenes.destroy', $imagen->id) }}" method="POST"
                            style="position:absolute; top:5px; right:5px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Eliminar esta imagen?')">✖</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mt-2">Este trabajo no tiene imágenes cargadas.</p>
        @endif
    </div>
@endsection
