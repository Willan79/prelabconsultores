@extends('layouts.app_admin')

@section('titulo')
    - Detalle de Auditoría
@endsection

@section('contenido')
    <div class="container magen-top-admin d-flex justify-content-center align-items-center ">
        <div class="card col-8 shadow">
            <div class="card-body">

                <div class="d-flex gap-4">
                    <h5 class="card-title">Empresa:</h5>
                    <p class="card-text">{{ $auditoria->empresa->nombre}}</p>
                </div>

                <div class="d-flex gap-4">
                    <h5 class="card-title">Consultor:</h5>
                    <p class="card-text">{{ $auditoria->user->name . ' ' . $auditoria->user->apellido }}</p>
                </div>

                <div class="d-flex gap-4">
                    <h5 class="card-title">Fecha:</h5>
                    <p class="card-text">{{ \Carbon\Carbon::parse($auditoria->fecha)->format('d/m/Y') }}</p>
                </div>

                <div class="d-flex gap-4">
                    <h5 class="card-title">Estado:</h5>
                    <p class="card-text text-capitalize">{{ $auditoria->estado }}</p>
                </div>

                <h5 class="card-title">Resultado:</h5>
                <p class="card-text">{{ $auditoria->resultado ?: 'Sin resultado registrado' }}</p>

                <h5 class="card-title">Observaciones:</h5>
                <p class="card-text">{{ $auditoria->observaciones ?: 'Sin observaciones' }}</p>

                <a href="{{ route('auditorias') }}" class="btn btn-secondary mt-3">Volver al listado</a>
                <a href="{{ route('auditorias_edit', $auditoria) }}" class="btn btn-primary mt-3">Editar Auditoría</a>
            </div>
        </div>
    </div>
@endsection
