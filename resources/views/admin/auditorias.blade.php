@extends('layouts.app_admin')

@section('titulo')
    - Auditorias
@endsection

@section('contenido')
    <div class="container magen-top-admin">

        <a href="{{ route('auditoria_crear') }}" class="btn btn-primary mb-3">Nueva Auditoría</a>
        <x-alerta tipo="success" :mensaje="session('success')" />

        <table class="table table-bordered table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Empresa</th>
                    <th>Consultor</th>
                    <th>Fecha asignada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditorias as $auditoria)
                    <tr>
                        <td>{{ $auditoria->empresa->nombre }}</td>
                        <td>{{ $auditoria->user->name . ' ' . $auditoria->user->apellido }}</td>
                        <td>{{ $auditoria->fecha }}</td>
                        <td>
                            @php
                                switch ($auditoria->estado) {
                                    case 'pendiente':
                                        $color = 'text-danger';
                                        break;
                                    case 'en_proceso':
                                        $color = 'text-warning';
                                        break;
                                    case 'finalizada':
                                        $color = 'text-success';
                                        break;
                                    default:
                                        $color = 'text-secondary';
                                }
                            @endphp

                            <span
                                class="{{ $color }} fw-bold">{{ ucfirst(str_replace('_', ' ', $auditoria->estado)) }}</span>
                        </td>

                        <td>

                            <a href="{{ route('auditoria_ver', $auditoria->id) }}" class="btn btn-outline-info btn-sm">Ver</a>
                            <a href="{{ route('auditorias_edit', $auditoria) }}"
                                class="btn btn-outline-warning btn-sm">Editar</a>
                            <form action="{{ route('auditorias.destroy', $auditoria) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta auditoría?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $auditorias->links() }} <!-- Paginación -->
    </div>
@endsection
