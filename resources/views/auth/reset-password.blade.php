
<!-- ##################################################################### -->

@extends('layouts.app')

@section('contenido')
    <div class="container d-flex justify-content-center">

        <div class="card p-2 m-4 bg-secondary shadow-lg col-md-12 col-lg-6">

            <div class="d-flex justify-content-center gap-4 mb-2">
                <img class="logo img-fluid " src="{{ asset('img/logo.1.png') }}" alt="Logo" style="max-height: 70px;">
                <!-- Logo con altura máxima de 50px -->
                <h3 class="text-center d-flex align-items-center">Registrar</h3>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf <!-- Token de seguridad -->

                <!-- Token de restablecimiento de contraseña -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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

                <!-- Contraseña -->
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Contraseña">
                    </div>

                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-2">
                    <div class="d-flex align-items-center ">
                        <label for="password_confirmation" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
                    </div>
                </div>

                <!-- Botón de enviar -->
                <div class="d-flex justify-content-evenly ">

                    <button type="submit" class="btn btn-primary ">Restablecer contraseña</button>

                </div>
            </form>
        </div>
    </div>
@endsection
