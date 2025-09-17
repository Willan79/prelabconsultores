@extends('layouts.app_admin')

@section('titulo')
    - Usuarios Registrados
@endsection

@section('contenido')
    <div class="container magen-top-admin">

        {{-- Mensajes de éxito --}}
        <x-alerta tipo="success" :mensaje="session('success')" />
        {{-- Mensajes de error --}}
        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name . ' ' . $usuario->apellido }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ ucfirst($usuario->role) }}</td>
                            <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if ($usuario->email !== 'wcastro1279@gmail.com')
                                    <a href="{{ route('usuarios_edit', $usuario) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Está seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $usuarios->links() }} <!-- Paginación -->
        </div>
    </div>
@endsection
