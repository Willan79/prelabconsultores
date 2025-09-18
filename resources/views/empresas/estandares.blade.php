@extends('layouts.app')

@section('contenido')
    <div class="container magen-top-admin my-5">
        <div class="card">
            <div class="card-header">
                <h3>Estándares de la Empresa: {{ $empresa->nombre }}</h3>
            </div>
            <div class="card-body">
                @if ($estandares->isEmpty())
                    <p>No hay estándares registrados para esta empresa.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre del documento</th>
                                <th>Fecha de creación</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estandares as $estandar)
                                <tr>
                                    <td>{{ $estandar->nombre }}</td>
                                    <td>{{ $estandar->created_at->format('d/m/Y H:i') }}</td>
                                    {{-- Botón de descarga --}}
                                    <td>
                                    <a href="{{ route('estandares.descargar.cliente', ['empresa' => $empresa->id, 'id' => $estandar->id]) }}"
                                        class="btn btn-sm btn-outline-success">
                                        Descargar
                                    </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
@endsection
