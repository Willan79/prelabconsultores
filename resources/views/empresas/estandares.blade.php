@extends('layouts.app')

{{--
|--------------------------------------------------------------------------
| Vista: Estándares de Empresa (Cliente)
|--------------------------------------------------------------------------
| Descripción:
| Muestra el listado de documentos/estándares asociados a una empresa
| y permite su descarga por parte del cliente.
|
| Funcionalidades:
| - Visualizar estándares disponibles.
| - Descargar documentos.
| - Mostrar mensaje si no existen registros.
|
| Requisitos:
| - Variables:
|   - $empresa   (modelo Empresa)
|   - $estandares (colección de modelos Estandar)
|
| Rutas:
| - estandares.descargar.cliente
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@section('contenido')
    <div class="container magen-top-admin my-5">
        <div class="card shadow-sm">

            <div class="card-header text-center fw-bold">
                Estándares de la Empresa: {{ $empresa->nombre }}
            </div>

            <div class="card-body">
                @if ($estandares->isEmpty())
                    <p class="text-center text-muted mb-0">
                        No hay estándares registrados para esta empresa.
                    </p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>Documento</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estandares as $estandar)
                                    <tr>
                                        <td>{{ $estandar->nombre }}</td>
                                        <td class="text-center">
                                            {{ $estandar->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('estandares.descargar.cliente', [
                                                'empresa' => $empresa->id,
                                                'id' => $estandar->id,
                                            ]) }}"
                                                class="btn btn-sm btn-outline-success">
                                                Descargar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
