@extends('layouts.app_admin')

{{--
|--------------------------------------------------------------------------
| Vista: Listado de Empresas
|--------------------------------------------------------------------------
| Descripción:
| Muestra el listado paginado de empresas registradas en el sistema.
| Permite crear, editar, gestionar estándares y eliminar empresas.
|
| Funcionalidades:
| - Listado con paginación Bootstrap.
| - Indicador de representante asignado.
| - Acciones CRUD (Editar / Eliminar).
| - Enlace a gestión de estándares.
|
| Requisitos:
| - Variable $empresas (paginada).
| - Relaciones cargadas: Empresa -> User.
| - Rutas:
|   - nueva_empresa
|   - empresa_edit
|   - empresa.destroy
|   - estandares
|
| Componentes:
| - x-alerta (mensajes de éxito y error).
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@section('titulo')
    - Empresas
@endsection

@section('contenido')
    <div class="container magen-top">

        <div class="mb-2">
            <a href="{{ route('nueva_empresa') }}" class="btn btn-primary">
                Registrar Empresa
            </a>
        </div>

        <x-alerta tipo="success" :mensaje="session('success')" />

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-secondary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>NIT</th>
                        <th>Trabajadores</th>
                        <th>Representante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td>{{ str_pad($empresa->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->nit }}</td>
                            <td>{{ $empresa->num_trabajadores }}</td>

                            <td class="{{ $empresa->users ? '' : 'text-danger fw-bold' }}">
                                {{ $empresa->users ? $empresa->users->name . ' ' . $empresa->users->apellido : 'Sin asignar' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('empresa_edit', $empresa->id) }}" class="btn btn-sm btn-info mb-1">
                                    Editar
                                </a>

                                <a href="{{ route('estandares', $empresa->id) }}" class="btn btn-sm btn-primary mb-1">
                                    Estándares
                                </a>

                                <form action="{{ route('empresa.destroy', $empresa) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar esta empresa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $empresas->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
