@extends('layouts.app_admin')

{{--
|--------------------------------------------------------------------------
| Vista: Editar Empresa
|--------------------------------------------------------------------------
| Descripción:
| Permite editar los datos básicos de una empresa registrada.
|
| Funcionalidades:
| - Actualizar información de la empresa.
| - Asignar o remover representante.
|
| Requisitos:
| - Variables:
|   - $empresa (modelo Empresa).
|   - $usuarios (colección de usuarios disponibles).
|
| Rutas:
| - empresa.update (PUT)
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@section('titulo')
    - Editar empresa
@endsection

@section('contenido')
    <div class="container magen-top d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-2 mb-2 col-md-10 col-lg-6">
            <div class="card-body">

                <form action="{{ route('empresa.update', $empresa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                            value="{{ old('nombre', $empresa->nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nit" class="form-label fw-bold">NIT</label>
                        <input type="text" id="nit" name="nit" class="form-control"
                            value="{{ old('nit', $empresa->nit) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="razon_social" class="form-label fw-bold">Razón social</label>
                        <input type="text" id="razon_social" name="razon_social" class="form-control"
                            value="{{ old('razon_social', $empresa->razon_social) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="num_trabajadores" class="form-label fw-bold">Trabajadores</label>
                        <input type="number" id="num_trabajadores" name="num_trabajadores" class="form-control"
                            min="1" value="{{ old('num_trabajadores', $empresa->num_trabajadores) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="ciudad" class="form-label fw-bold">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" class="form-control"
                            value="{{ old('ciudad', $empresa->ciudad) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label fw-bold">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control"
                            value="{{ old('direccion', $empresa->direccion) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label fw-bold">Representante</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">Sin asignar</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ old('user_id', $empresa->user_id) == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }} ({{ $usuario->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
