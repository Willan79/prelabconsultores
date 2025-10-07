@extends('layouts.app_admin')

@section('titulo')
    - {{ $empresa->nombre }}
@endsection

@section('contenido')
    <div class="container magen-top-admin shadow p-4">
        <h2 class="mb-4">Estándares de {{ $empresa->nombre }}</h2>
        {{-- - Formulario para subir estándar - --}}
        <form action="{{ route('estandares.store', $empresa->id) }}" method="POST" enctype="multipart/form-data"
            class="mb-4">
            @csrf
            <div class="form-group mb-2">
                <input class="form-control-file" type="file" name="estandar" required>
            </div>
            <button type="submit" class="btn btn-outline-primary">Subir archivo</button>
        </form>

        @if (session('success'))
            <x-alerta tipo="success" :mensaje="session('success')" />
        @endif

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif
        {{-- Tabla de estándares --}}
        <table class="table table-bordered">
            @if ($estandares->isEmpty())
                <!-- Si no hay estándares -->
                <tr>
                    <td colspan="3" class="text-center">No hay archivos registrados.</td>
                </tr>
            @else
                {{-- Fila con total de estándares --}}
                <h5 class=" fw-bold">
                    <p  class="">Total de Archivos: {{ $estandares->count() }}</p>
                </h5>
            @endif
            <thead class="thead-dark">
                <tr>
                    <th>Nombre del Archivo</th>
                    <th>Subido</th>
                    <th>Subido por</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estandares as $estandar)
                    <tr>
                        <td class="w-25 ">{{ $estandar->nombre }}</td>
                        {{-- fecha y hora --}}
                        <td>{{ $estandar->created_at->format('d/m/Y') }}</td>
                        <td>{{ $estandar->usuario->name ?? 'Desconocido' }}</td>
                        <td>
                            {{-- Botón de descarga --}}
                            <a href="{{ route('estandares.descargar', ['empresa' => $empresa->id, 'id' => $estandar->id]) }}"
                                class="btn btn-sm btn-outline-success">
                                Descargar
                            </a>
                            {{-- Botón de eliminar --}}
                            <form
                                action="{{ route('estandares.destroy', ['empresa' => $empresa->id, 'id' => $estandar->id]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este estándar?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
