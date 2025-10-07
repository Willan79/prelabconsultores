<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    //Mostrar la vista de registro.
    public function create(): View
    {
        return view('auth.register');
    }
    //Gestionar una solicitud de registro entrante.
    // @throws \Illuminate\Validation\ValidationException
    public function store(Request $request):RedirectResponse
    {
        //Validación
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'apellido' => 'required|string',
            'telefono' => 'required',
            'direccion' => 'required|string',
        ]);

        $role = $request->email === 'wcastro1279@gmail.com' ? 'admin' : 'cliente';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'role' => $role,
        ]);

        // Esto dispara el evento Registered que Laravel incluye por defecto cuando se registra un nuevo usuario.
        event(new Registered($user));

        // Este comando inicia sesión automáticamente al nuevo usuario que acaba de registrarse.
        Auth::login($user);

        //  Redirección según el rol
        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }

        return redirect()->intended('/');

        //! return de prueba en Thunder Client
        /*
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Usuario registrado correctamente',
                'user' => $user
            ], 201);
        } */
    }
}
