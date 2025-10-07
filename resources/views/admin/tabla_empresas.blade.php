@extends('layouts.app_admin')
@section('titulo')
    - Empresas
@endsection
@section('contenido')
    <!-- Contenido principal -->
    <div class="magen-top-admin container">

        <div>
            <a href="{{ route('nueva_empresa') }}" class="btn btn-primary mb-1">Registrar Empresa</a>
        </div>

        <x-alerta tipo="success" :mensaje="session('success')" />

        @if ($errors->any())
            <x-alerta tipo="danger" :mensaje="$errors->first()" />
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-secondary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>NIT</th>
                        <th>Trabajadores</th>
                        <th>Representante</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr class="tabla-empresa-td align-middle">
                            <td>{{ "00" . $empresa->id }}</td>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->nit }}</td>
                            <td>{{ $empresa->num_trabajadores }}</td>
                            {{-- Si no hay usuario asignado, mostrar "Sin asignar" en rojo --}}
                            {{-- Si hay usuario asignado, mostrar el nombre completo --}}
                            <td class="{{ $empresa->users ? '' : 'text-danger' }}">
                                {{ $empresa->users ? $empresa->users->name . ' ' . $empresa->users->apellido : 'Sin asignar' }}
                            </td>

                            <td class="text-center w-25">
                                <a href="{{ route('empresa_edit', $empresa->id) }}"
                                    class="btn btn-sm btn-info mb-1">Editar</a>
                                <a href="{{ route('estandares', $empresa->id) }}"
                                    class="btn btn-sm btn-primary mb-1">Estándares</a>
                                <form action="{{ route('empresa.destroy', $empresa) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar esta empresa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p>
                Mostrando {{ $empresas->firstItem() }} a {{ $empresas->lastItem() }}
                de {{ $empresas->total() }} resultados
            </p>

            {{ $empresas->links('pagination::bootstrap-5') }} <!-- Paginación -->
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm("¿Estás seguro de que deseas eliminar esta empresa?");
        }
    </script>
@endsection
