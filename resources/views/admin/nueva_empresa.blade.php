@extends('layouts.app_admin')

@section('titulo')
    - Registar Empresa
@endsection

@section('contenido')
    <div class="container magen-top-admin d-flex justify-content-center align-items-center">

        <div class="card shadow-lg p-2 col-md-10 col-lg-6" id="login-bg">

            <div class="card-body">

                <div class="d-flex justify-content-center gap-4 mb-2">
                    <img class="logo img-fluid " src="{{ asset('img/FINAL.png') }}" alt="Logo" style="max-height: 50px;">
                </div>

                <form action="{{ route('nueva_empresa') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token de seguridad -->

                    <!-- Nombre -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                                name="nombre" placeholder="Nombre de la empresa" value="{{ old('nombre') }}" required>
                        </div>
                    </div>

                    <!-- nit -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="nit" class="form-label">Nit</label>
                            <input type="text" class="form-control @error('nit') is-invalid @enderror" id="nit"
                                name="nit" placeholder="Nit" value="{{ old('nit') }}" required>
                        </div>
                    </div>


                    <!-- razon_social -->

                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="razon_social" class="form-label">Razon_social</label>
                            <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="razon_social"
                                name="razon_social" placeholder="Razon social" value="{{ old('razon_social') }}" required>
                        </div>
                    </div>

                    <!-- num_trabajadores -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="num_trabajadores" class="form-label">Trabajadores</label>
                            <input type="number" class="form-control @error('num_trabajadores') is-invalid @enderror" id="num_trabajadores"
                                name="num_trabajadores" placeholder="numero de trabajadores" value="{{ old('num_trabajadores') }}" required>
                        </div>
                    </div>

                    <!-- ciudad -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control @error('ciudad') is-invalid @enderror" id="ciudad"
                                name="ciudad" placeholder="Ciudad" value="{{ old('ciudad') }}" required>
                        </div>
                    </div>

                    <!-- direccion -->

                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                                name="direccion" placeholder="Dirección" value="{{ old('direccion') }}" required>
                        </div>
                    </div>

                    <div class="nueva-empresa-campos form-group mb-3">
                        <label for="user_id">Representánte</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">Sin asignar</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" required>{{ $usuario->name }} ({{ $usuario->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <div class="alert alert-danger text-center p-2">{{ $message }}</div>
                    @enderror

                    <!-- Botón de Enviar -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
