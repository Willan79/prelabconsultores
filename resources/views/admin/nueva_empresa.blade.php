@extends('layouts.app_admin')

{{--
|--------------------------------------------------------------------------
| Vista: Registrar Empresa
|--------------------------------------------------------------------------
| Descripción:
| Formulario para el registro de nuevas empresas dentro del panel
| administrativo. Permite almacenar información básica de la empresa
| y asignar opcionalmente un representante (usuario del sistema).
|
| Funcionalidades:
| - Validación de campos obligatorios.
| - Asociación con usuario representante.
| - Manejo de errores con mensajes visuales.
|
| Requisitos:
| - Variable $usuarios (lista de usuarios).
| - Ruta 'nueva_empresa' definida.
| - Layout: layouts.app_admin.
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@section('titulo')
    - Registrar Empresa
@endsection

@section('contenido')
    <div class="container my-5 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg col-md-10 col-lg-6 mt-5" id="login-bg">
            <div class="card-body bg-light">

                <div class="d-flex justify-content-center">
                    <img src="{{ asset('img/FINAL.png') }}" alt="Logo Prelab" class="img-fluid" style="max-height: 50px;">
                </div>

                <form action="{{ route('nueva_empresa') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-control  @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="nit" class="form-label">NIT</label>
                        <input type="text" name="nit" id="nit"
                            class="form-control @error('nit') is-invalid @enderror" value="{{ old('nit') }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="razon_social" class="form-label">Razón social</label>
                        <input type="text" name="razon_social" id="razon_social"
                            class="form-control @error('razon_social') is-invalid @enderror"
                            value="{{ old('razon_social') }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="num_trabajadores" class="form-label">Trabajadores</label>
                        <input type="number" name="num_trabajadores" id="num_trabajadores"
                            class="form-control @error('num_trabajadores') is-invalid @enderror"
                            value="{{ old('num_trabajadores') }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad"
                            class="form-control @error('ciudad') is-invalid @enderror" value="{{ old('ciudad') }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion"
                            class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}"
                            required>
                    </div>

                    <div class="mb-2">
                        <label for="user_id" class="form-label">Representante</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">Sin asignar</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">
                                    {{ $usuario->name }} ({{ $usuario->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Guardar empresa
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
