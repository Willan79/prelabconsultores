{{--
|--------------------------------------------------------------------------
| Vista de Autenticación - Registro de Usuario
|--------------------------------------------------------------------------
| Archivo: resources/views/auth/register.blade.php
|
| Descripción:
| Formulario de registro de nuevos usuarios del sistema.
| Permite crear una cuenta mediante datos personales y credenciales.
|
| Funcionalidades:
| - Registro con nombre, apellido, email, dirección y teléfono.
| - Validación del backend con feedback visual.
| - Enlace a vista de login.
|
| Seguridad:
| - Protección CSRF.
| - Confirmación de contraseña.
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
    <section class="container d-flex justify-content-center align-items-center min-vh-100 mt-2">

        <article class="card shadow-lg p-4 col-md-12 col-lg-6">

            <header class="d-flex justify-content-center align-items-center gap-3 mb-4">
                <img src="{{ asset('img/FINAL.png') }}" alt="Logo Prelab" class="img-fluid" style="max-height: 70px;">
                <h1 class="fs-3 mb-0">Registro de usuario</h1>
            </header>

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                {{-- Nombre --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required>
                </div>

                {{-- Apellido --}}
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                        name="apellido" value="{{ old('apellido') }}" required>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Dirección --}}
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                        name="direccion" value="{{ old('direccion') }}" required>
                </div>

                {{-- Teléfono --}}
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                        name="telefono" value="{{ old('telefono') }}" required>
                </div>

                {{-- Contraseña --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                </div>

                {{-- Confirmación --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Confirmar contraseña
                    </label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">
                        Registrar
                    </button>

                    <a href="{{ route('login') }}" class="small">
                        Ya tengo cuenta
                    </a>
                </div>

            </form>
        </article>
    </section>
@endsection
