{{--
|--------------------------------------------------------------------------
| Vista: Listado de Auditorías
|--------------------------------------------------------------------------
| Descripción:
| Muestra el listado general de auditorías registradas en el sistema.
| Permite crear, visualizar, editar y eliminar auditorías.
|
| Funcionalidades:
| - Listado con paginación.
| - Indicador visual del estado de cada auditoría.
| - Acciones CRUD (Ver, Editar, Eliminar).
|--------------------------------------------------------------------------
--}}

@extends('layouts.app_admin')

@section('titulo')
    - Auditorías
@endsection

@section('contenido')
    <main class="container magen-top">

        <section class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Listado de Auditorías</h4>
            <a href="{{ route('auditoria_crear') }}" class="btn btn-primary">
                Crear Auditoría
            </a>
        </section>

        <x-alerta tipo="success" :mensaje="session('success')" />

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-secondary text-center">
                    <tr>
                        <th scope="col">Empresa</th>
                        <th scope="col">Consultor</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="w-25">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($auditorias as $auditoria)
                        <tr>
                            <td>{{ $auditoria->empresa->nombre }}</td>
                            <td>
                                {{ $auditoria->user->name }}
                                {{ $auditoria->user->apellido }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($auditoria->fecha)->format('d/m/Y') }}
                            </td>
                            <td>
                                <span
                                    class="fw-bold
                                    @if ($auditoria->estado === 'pendiente') text-danger
                                    @elseif($auditoria->estado === 'en_proceso') text-primary
                                    @elseif($auditoria->estado === 'finalizada') text-success
                                    @else text-secondary @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $auditoria->estado)) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('auditoria_ver', $auditoria) }}" class="btn btn-outline-info btn-sm">
                                    Ver
                                </a>

                                <a href="{{ route('auditorias_edit', $auditoria) }}" class="btn btn-outline-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('auditorias.destroy', $auditoria) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Deseas eliminar esta auditoría?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No hay auditorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $auditorias->links('pagination::bootstrap-5') }}
        </div>
    </main>
@endsection
