{{--
|--------------------------------------------------------------------------
| Vista: Crear Auditoría
|--------------------------------------------------------------------------
| Descripción:
| Formulario para registrar una nueva auditoría en el sistema.
| Permite seleccionar empresa, consultor, fecha, estado y observaciones.
|
| Buenas prácticas aplicadas:
| - CSRF para seguridad.
| - Uso de Bootstrap 5 para layout responsive.
|--------------------------------------------------------------------------
--}}
{{-- Backend --}}
@extends('layouts.app_admin')

@section('titulo')
    - Crear auditoría
@endsection

@section('contenido') 
    <main class="container magen-top d-flex justify-content-center">

        <article class="card shadow-lg col-md-10 col-lg-6 mb-2" id="login-bg">
            <div class="card-body">

                <header class="d-flex gap-4 mb-2">
                    <img class="img-fluid" src="{{ asset('img/FINAL.png') }}" alt="Logo Prelab" style="max-height: 50px;">
                    <h4 class="fw-bold">Crear Auditoría</h4>
                </header>

                <form action="{{ route('auditoria_crear') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="empresa_id" class="form-label">Empresa</label>
                        <select id="empresa_id" name="empresa_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">
                                    {{ $empresa->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Consultor</label>
                        <select id="user_id" name="user_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach ($users as $usuario)
                                <option value="{{ $usuario->id }}">
                                    {{ $usuario->name }} {{ $usuario->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('fecha') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" name="estado" class="form-select" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_proceso">En proceso</option>
                            <option value="finalizada">Finalizada</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="resultado" class="form-label">Resultado</label>
                        <textarea id="resultado" name="resultado" class="form-control" rows="3">{{ old('resultado') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('auditorias') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>
        </article>
    </main>
@endsection
