{{--
|--------------------------------------------------------------------------
| Vista: Crear Nuevo Trabajo
|--------------------------------------------------------------------------
| Descripción:
| Vista administrativa para registrar un nuevo trabajo realizado.
| Permite definir título, descripción, empresa asociada y subir
| múltiples imágenes opcionales.
|
| Funcionalidades:
| - Validación con feedback visual.
| - Persistencia de datos con old().
| - Subida de múltiples archivos.
| - Mensajes de error por campo.
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}


@extends('layouts.app_admin')

@section('titulo')
    - Nuevo Trabajo
@endsection

@section('contenido')

    <section class="container magen-top-admin my-5 d-flex flex-column align-items-center"
        aria-labelledby="nuevo-trabajo-title">

        <header class="mt-5">
            <h2 id="nuevo-trabajo-title">Compartir un Trabajo Realizado</h2>
        </header>

        {{-- Errores globales --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('trabajos.store') }}" method="POST" enctype="multipart/form-data"
            class="shadow-lg p-4 rounded col-md-8" novalidate>

            @csrf

            {{-- Título --}}
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del trabajo</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                    class="form-control @error('titulo') is-invalid @enderror" required>
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3"
                    class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Empresa --}}
            <div class="mb-3">
                <label for="empresa_id" class="form-label">Empresa Cliente</label>
                <select name="empresa_id" id="empresa_id" class="form-select @error('empresa_id') is-invalid @enderror"
                    required>
                    <option value="">Selecciona una empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}" {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('empresa_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Imágenes --}}
            <div class="mb-4">
                <label for="imagens" class="form-label">
                    Imágenes del trabajo (opcional)
                </label>
                <input type="file" name="imagens[]" id="imagens"
                    class="form-control @error('imagens') is-invalid @enderror" accept="image/*" multiple>
                @error('imagens')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <footer class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">
                    Guardar
                </button>
                <a href="{{ route('trabajos.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </footer>

        </form>

    </section>

@endsection
