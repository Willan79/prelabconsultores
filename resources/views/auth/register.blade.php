@extends('layouts.app')

@section('contenido')
    <div class="register d-flex justify-content-center mb-4">

        <div class="form card p-2 shadow-lg col-md-12 col-lg-6">

            <div class="d-flex justify-content-center gap-4 mb-2">
                <img class="logo img-fluid " src="{{ asset('img/FINAL.png') }}" alt="Logo" style="max-height: 70px;">
                <p class="fs-3">REGISTRARSE</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf <!-- Token de seguridad -->

                <!-- Nombre -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nombre" value="{{ old('name') }}" required>
                    </div>
                </div>

                <!-- Apellido -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                            name="apellido" placeholder="Apellido" value="{{ old('apellido') }}" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                            name="direccion" placeholder="Dirección Completa" value="{{ old('direccion') }}" required>
                    </div>
                </div>

                <!-- Teléfono -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required>
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Contraseña" required>
                    </div>

                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-2">
                    <div class="d-flex align-items-center ">
                        <label for="password_confirmation" class="form-label">Confirmar</br> Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botón de enviar -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary ">Registrar</button>
                    <a href="{{ route('login') }}" class="">Estoy registrado</a>
                </div>
            </form>
        </div>
    </div>
@endsection
