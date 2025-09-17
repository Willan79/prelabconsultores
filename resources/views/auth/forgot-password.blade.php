<!-- ############################################################################## -->

@extends('layouts.app')

@section('contenido')
    <div class=" container d-flex justify-content-center align-items-center mb-4">

        <div class="form card shadow-lg p-2 col-md-10 col-lg-6" id="login-bg">

            <div class="d-flex justify-content-center gap-4">
                <img class="logo img-fluid mb-4" src="{{ asset('img/FINAL.png') }}" alt="Logo" style="max-height: 70px;">
            </div>

            <p>
                ¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu correo electrónico y te enviaremos
                un enlace para restablecer tu contraseña y podrás elegir una nueva.
                Email

            </p>

            <!-- Estado de la sesión -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf <!-- Token de seguridad -->

                @if (@session('mensaje'))
                    <div class="text-danger text-center fs-5">{{ session('mensaje') }}</div>
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Email" value="{{ old('email') }}" />
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="btn btn-primary">
                        {{ __('Enlace de restablecimiento de contraseña') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
