@extends('layouts.app')

@section('contenido')
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h3>Detalles de la Empresa</h3>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $empresa->nombre }}</p>
                <p><strong>NIT:</strong> {{ $empresa->nit }}</p>
                <p><strong>Razón Social:</strong> {{ $empresa->razon_social }}</p>
                <p><strong>Número de Trabajadores:</strong> {{ $empresa->num_trabajadores }}</p>
                <p><strong>Ciudad:</strong> {{ $empresa->ciudad }}</p>
                <p><strong>Dirección:</strong> {{ $empresa->direccion }}</p>
                <p><strong>Representante:</strong> {{ $empresa->users->name ?? 'Nulo' }}</p>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('empresa.estandares.cliente', $empresa->id) }}" class="btn btn-primary">
                    Ver Estándares
                </a>
            </div>

        </div>
    </div>
@endsection
