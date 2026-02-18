@extends('layouts.app')

{{--
|--------------------------------------------------------------------------
| Vista: Detalle de Empresa (Cliente)
|--------------------------------------------------------------------------
| Descripción:
| Muestra la información completa de la empresa asociada al usuario cliente.
|
| Funcionalidades:
| - Visualizar datos básicos de la empresa.
| - Acceder a los estándares asignados.
|
| Requisitos:
| - Variable:
|   - $empresa (modelo Empresa con relación users).
|
| Rutas:
| - empresa.estandares.cliente
|
| Buenas prácticas aplicadas:
| - HTML semántico con listas descriptivas.
| - Validación de relaciones nulas.
| - Diseño responsive con Bootstrap.
|
| Autor: Equipo Prelab
| Fecha: 2026
|--------------------------------------------------------------------------
--}}

@section('contenido')
    <div class="container d-flex justify-content-center">
        <div class="card col-lg-6 shadow-sm">

            <div class="card-header text-center fw-bold">
                Detalles de la Empresa
            </div>

            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Nombre</dt>
                    <dd class="col-sm-7">{{ $empresa->nombre }}</dd>

                    <dt class="col-sm-5">NIT</dt>
                    <dd class="col-sm-7">{{ $empresa->nit }}</dd>

                    <dt class="col-sm-5">Razón social</dt>
                    <dd class="col-sm-7">{{ $empresa->razon_social }}</dd>

                    <dt class="col-sm-5">Trabajadores</dt>
                    <dd class="col-sm-7">{{ $empresa->num_trabajadores }}</dd>

                    <dt class="col-sm-5">Ciudad</dt>
                    <dd class="col-sm-7">{{ $empresa->ciudad }}</dd>

                    <dt class="col-sm-5">Dirección</dt>
                    <dd class="col-sm-7">{{ $empresa->direccion }}</dd>

                    <dt class="col-sm-5">Representante</dt>
                    <dd class="col-sm-7">
                        {{ $empresa->users?->name ?? 'Sin asignar' }}
                    </dd>
                </dl>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('empresa.estandares.cliente', $empresa->id) }}" class="btn btn-primary">
                    Ver estándares
                </a>
            </div>

        </div>
    </div>
@endsection
