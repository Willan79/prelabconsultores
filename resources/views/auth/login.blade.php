{{--
|--------------------------------------------------------------------------
| Vista de Autenticación - Login
|--------------------------------------------------------------------------
| Archivo: resources/views/auth/login.blade.php
|
| Descripción:
| Formulario de inicio de sesión para usuarios del sistema.
| Permite autenticación mediante email y contraseña.
|
| Funcionalidades:
| - Envío de credenciales al endpoint /login.
| - Mensajes de error y éxito con componente <x-alerta>.
| - Opción de "recordar sesión".
| - Enlace de recuperación de contraseña.
|
| Seguridad:
| - Protección CSRF.
| - Inputs con validación del backend.
|
| Dependencias:
| - Laravel Auth
| - Bootstrap 5
|
| Autor: Willian Castro
| Fecha: 2025
|--------------------------------------------------------------------------
--}}

@extends('layouts.app')

@section('contenido')
    <section class="container d-flex justify-content-center align-items-center min-vh-100">

        <article class="card shadow-lg p-4 col-md-10 col-lg-6" id="login-bg">

            <header class="d-flex justify-content-center align-items-center gap-3 mb-4">
                <img src="{{ asset('img/FINAL.png') }}" alt="Logo Prelab" class="img-fluid" style="max-height: 70px;">
                <h1 class="fs-3 mb-0">Inicio de sesión</h1>
            </header>

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                {{-- Mensajes --}}
                @if (session('success'))
                    <x-alerta tipo="success" :mensaje="session('success')" />
                @endif

                @if ($errors->any())
                    <x-alerta tipo="danger" :mensaje="$errors->first()" />
                @endif

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" placeholder="usuario@correo.com" required autofocus>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                </div>

                {{-- Remember --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Mantener sesión iniciada
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">
                        Iniciar sesión
                    </button>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

            </form>
        </article>
    </section>
@endsection
