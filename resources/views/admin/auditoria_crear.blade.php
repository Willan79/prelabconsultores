<!--=================================================================================-->

@extends('layouts.app_admin')

@section('titulo')
    - Crear auditoria
@endsection

@section('contenido')
    <div class="container magen-top-admin d-flex justify-content-center align-items-center">

        <div class="form card shadow-lg col-md-10 col-lg-6" id="login-bg">

            <div class=" card-body ">

                <div class="d-flex justify-content-center gap-4 mb-2">
                    <img class="logo img-fluid" src="{{ asset('img/FINAL.png') }}" alt="Logo" style="max-height: 50px;">

                </div>

                <form action="{{ route('auditoria_crear') }}" method="POST">
                    @csrf

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="empresa_id" class="form-label">Empresa</label>
                        <select name="empresa_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="user_id" class="form-label">Consultor</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach ($users as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_proceso">En proceso</option>
                            <option value="finalizada">Finalizada</option>
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="resultado" class="form-label">Resultado</label>
                        <textarea name="resultado" class="form-control">{{ old('resultado') }}</textarea>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('auditorias') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
