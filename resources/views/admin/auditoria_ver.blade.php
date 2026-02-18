{{--
|--------------------------------------------------------------------------
| Vista: Detalle de Auditoría
|--------------------------------------------------------------------------
| Descripción:
| Muestra la información completa de una auditoría específica.
| Presenta datos de empresa, consultor, estado y resultados.
|
| Funcionalidades:
| - Visualización clara de todos los campos relevantes.
| - Botones para volver a la lista o editar la auditoría.
|--------------------------------------------------------------------------
--}}

@extends('layouts.app_admin')

@section('titulo')
    - Detalle de Auditoría
@endsection

@section('contenido')
    <main class="container magen-top d-flex justify-content-center">

        <article class="card col-lg-8 shadow">
            <div class="card-body">

                <header class="mb-4">
                    <h4 class="fw-bold text-center">Detalle de Auditoría</h4>
                </header>

                <dl class="row">
                    <dt class="col-sm-4">Empresa</dt>
                    <dd class="col-sm-8">{{ $auditoria->empresa->nombre }}</dd>

                    <dt class="col-sm-4">Consultor</dt>
                    <dd class="col-sm-8">
                        {{ $auditoria->user->name }} {{ $auditoria->user->apellido }}
                    </dd>

                    <dt class="col-sm-4">Fecha</dt>
                    <dd class="col-sm-8">
                        {{ \Carbon\Carbon::parse($auditoria->fecha)->format('d/m/Y') }}
                    </dd>

                    <dt class="col-sm-4">Estado</dt>
                    <dd class="col-sm-8 text-capitalize">
                        {{ $auditoria->estado }}
                    </dd>

                    <dt class="col-sm-4">Resultado</dt>
                    <dd class="col-sm-8">
                        {{ $auditoria->resultado ?: 'Sin resultado registrado' }}
                    </dd>

                    <dt class="col-sm-4">Observaciones</dt>
                    <dd class="col-sm-8">
                        {{ $auditoria->observaciones ?: 'Sin observaciones' }}
                    </dd>
                </dl>

                <footer class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('auditorias') }}" class="btn btn-secondary">
                        Volver
                    </a>
                    <a href="{{ route('auditorias_edit', $auditoria) }}" class="btn btn-primary">
                        Editar
                    </a>
                </footer>

            </div>
        </article>
    </main>
@endsection
