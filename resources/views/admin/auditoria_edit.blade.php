<!-- -->
@extends('layouts.app_admin')

@section('titulo')
    - Editar Auditoría
@endsection

@section('contenido')
    <div class="container magen-top-admin d-flex justify-content-center align-items-center">

        <div class="form card shadow-lg p-2 col-md-10 col-lg-6" id="login-bg">

            <div class=" card-body ">

                <form action="{{ route('auditorias.update', $auditoria) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="empresa_id" class="form-label">Empresa</label>
                        <select name="empresa_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}"
                                    {{ $auditoria->empresa_id == $empresa->id ? 'selected' : '' }}>
                                    {{ $empresa->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="user_id" class="form-label">Consultor</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            <!---->
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ $auditoria->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control"
                            value="{{ old('fecha', $auditoria->fecha) }}" required>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="pendiente" {{ $auditoria->estado == 'pendiente' ? 'selected' : '' }}>Pendiente
                            </option>
                            <option value="en_proceso" {{ $auditoria->estado == 'en_proceso' ? 'selected' : '' }}>En proceso
                            </option>
                            <option value="finalizada" {{ $auditoria->estado == 'finalizada' ? 'selected' : '' }}>
                                Finalizada</option>
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="resultado" class="form-label">Resultado</label>
                        <textarea name="resultado" class="form-control">{{ old('resultado', $auditoria->resultado) }}</textarea>
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-2">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control">{{ old('observaciones', $auditoria->observaciones) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="{{ route('auditorias') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
