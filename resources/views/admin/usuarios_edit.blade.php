@extends('layouts.app_admin')

@section('titulo')
    - Editar Usuario
@endsection

@section('contenido')
<div class="container magen-top-admin col-md-4 shadow p-4">
    <h3>Editar Rol de {{ $usuario->name }}</h3>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select name="role" class="form-select" required>

                <option value="consultor" {{ $usuario->role == 'consultor' ? 'selected' : '' }}>Consultor</option>
                <option value="cliente" {{ $usuario->role == 'cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="admin" {{ $usuario->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
        <a href="{{ route('tabla_user') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
