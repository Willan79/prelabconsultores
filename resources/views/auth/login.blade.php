<!-- ######################################################################### -->

@extends('layouts.app')

@section('contenido')
    <div class=" container d-flex justify-content-center align-items-center mb-4">

        <div class="form card shadow-lg p-2 col-md-10 col-lg-6" id="login-bg">

            <div class="d-flex justify-content-center gap-4">
                <img class="logo img-fluid " src="{{ asset('img/FINAL.png') }}" alt="Logo" style="max-height: 70px;">
                <p class="fs-3">Inicio de sesión</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf <!-- Token de seguridad -->

                @if (session('success'))
                    <x-alerta tipo="success" :mensaje="session('success')" />
                @endif

                @if ($errors->any())
                    <x-alerta tipo="danger" :mensaje="$errors->first()" />
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Email" value="{{ old('email') }}" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Contraseña" />
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Mantaner sesión</label>
                </div>

                <div class="d-flex justify-content-between">

                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                </div>
                <!-- Sí la ruta existe se muestra -->
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

            </form>

        </div>
    </div>
@endsection
