<?php

/**
 * Middleware AdminMiddleware
 * ------------------------------------------------------
 * Este middleware se encarga de restringir el acceso a rutas
 * exclusivas para usuarios con rol "admin" dentro del sistema.
 *
 * RESPONSABILIDAD PRINCIPAL:
 * - Verificar si el usuario está autenticado
 * - Comprobar que el rol del usuario sea "admin"
 * - Permitir o denegar el acceso a recursos protegidos
 *
 * FUNCIONAMIENTO:
 * 1. Comprueba si el usuario ha iniciado sesión (Auth::check())
 * 2. Verifica el rol del usuario autenticado
 * 3. Si es administrador → permite continuar la solicitud
 * 4. Si no es administrador → redirige a la página principal
 *
 * USO TÍPICO EN RUTAS:
 * Route::middleware(['admin'])->group(function () {
 *     // Rutas solo para administradores
 * });
 */


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Manejar una solicitud entrante
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Permitir el acceso
        }
        return redirect('/'); // Redirigir si no es admin
    }

}
