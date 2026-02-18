{{--
|--------------------------------------------------------------------------
| Vista: Listado de Usuarios
|--------------------------------------------------------------------------
| Descripción:
| Muestra todos los usuarios registrados en el sistema.
|
| Funcionalidades:
| - Listado paginado de usuarios.
| - Acciones para editar o eliminar usuarios.
| - Protección para no eliminar al super admin.
|--------------------------------------------------------------------------
--}}

@extends('layouts.app_admin')

@section('titulo')
    - Usuarios Registrados
@endsection

@section('contenido')
    <main class="container magen-top">

        {{-- Alertas de sistema --}}
        <x-alerta tipo="success" :mensaje="session('success')" />
        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        <section class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-secondary text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Fecha registro</th>
                        <th scope="col" class="w-25">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>
                                {{ $usuario->name }}
                                {{ $usuario->apellido }}
                            </td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ ucfirst($usuario->role) }}</td>
                            <td>
                                {{ $usuario->created_at->format('d/m/Y') }}
                            </td>

                            <td class="text-center">
                                @if ($usuario->email !== 'wcastro1279@gmail.com')
                                    <a href="{{ route('usuarios_edit', $usuario) }}" class="btn btn-outline-primary btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted fst-italic">
                                        Super Admin
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <div class="d-flex justify-content-end">
            {{ $usuarios->links('pagination::bootstrap-5') }}
        </div>

    </main>
@endsection
