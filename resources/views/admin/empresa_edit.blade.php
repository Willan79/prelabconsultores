@extends('layouts.app_admin')

@section('titulo')
    - Editar empresa
@endsection

@section('contenido')
    <!-- Contenedor principal con margen superior y ancho del 50% -->
    <div class="container magen-top-admin d-flex justify-content-center align-items-center">

        <div class="form card shadow-lg p-2 col-md-10 col-lg-6" id="login-bg">

            <div class=" card-body ">

                <!--formulario de edición -->

                <form action="{{ route('empresa.update', $empresa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Método HTTP para actualizar el recurso -->

                    <!-- Nombre de la empresa -->
                    <div class="formu mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control"
                            value="{{ $empresa->nombre }}">
                    </div>

                    <!--  -->
                    <div class="formu mb-3">
                        <label for="nit" class="form-label fw-bold">Nit</label>
                        <input type="number" id="nit" name="nit" class="form-control" value="{{ $empresa->nit }}"
                            step="0.01">
                    </div>

                    <!--  -->
                    <div class="formu mb-3">
                        <label for="razon_social" class="form-label fw-bold">Razon_social</label>
                        <input type="text" id="razon_social" name="razon_social" class="form-control"
                            value="{{ $empresa->razon_social }}" min="1">
                    </div>

                    <!--  -->
                    <div class="formu mb-3">
                        <label for="num_trabajadores" class="form-label fw-bold">Num_trabajadores</label>
                        <input type="number" id="num_trabajadores" name="num_trabajadores" class="form-control"
                            value="{{ $empresa->num_trabajadores }}" min="1">
                    </div>

                    <!--  -->
                    <div class="formu mb-3">
                        <label for="ciudad" class="form-label fw-bold">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" class="form-control"
                            value="{{ $empresa->ciudad }}" min="1">
                    </div>

                    <!--  -->
                    <div class="formu mb-3">
                        <label for="direccion" class="form-label fw-bold">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control"
                            value="{{ $empresa->direccion }}" min="1">
                    </div>

                    <!--  -->
                    <div class="formu form-group mb-3">
                        <label for="user_id" class="form-label fw-bold">Representánte</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="" {{ $empresa->user_id ? '' : 'selected' }}>Sin asignar</option>{{--  Si no hay usuario asignado, se selecciona esta opción --}}
                            {{-- Si hay un usuario asignado, se selecciona esa opción --}}
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ $empresa->user_id == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }} ({{ $usuario->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón para enviar el formulario -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
