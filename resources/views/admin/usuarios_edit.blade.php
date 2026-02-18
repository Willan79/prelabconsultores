{{--
|--------------------------------------------------------------------------
| Vista: Editar Rol de Usuario
|--------------------------------------------------------------------------
| Descripción:
| Permite al administrador modificar el rol de un usuario del sistema.
|
| Funcionalidades:
| - Formulario para seleccionar un nuevo rol (admin, consultor, cliente).
|--------------------------------------------------------------------------
--}}

@extends('layouts.app_admin')

@section('titulo')
    - Editar Usuario
@endsection

@section('contenido')
    <main class="container magen-top d-flex justify-content-center">

        <section class="card shadow col-md-6 col-lg-4 p-4">

            <header class="mb-3">
                <h3 class="text-center">
                    Editar rol de <strong>{{ $usuario->name }}</strong>
                </h3>
            </header>

            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="role" class="form-label fw-bold">Rol del usuario</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="consultor" {{ $usuario->role === 'consultor' ? 'selected' : '' }}>
                            Consultor
                        </option>
                        <option value="cliente" {{ $usuario->role === 'cliente' ? 'selected' : '' }}>
                            Cliente
                        </option>
                        <option value="admin" {{ $usuario->role === 'admin' ? 'selected' : '' }}>
                            Administrador
                        </option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        Actualizar rol
                    </button>

                    <a href="{{ route('tabla_user') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </form>

        </section>
    </main>
@endsection
