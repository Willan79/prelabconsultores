<?php

/**
 * Controlador ProfileController
 * ------------------------------------------------------
 * Este controlador gestiona el perfil del usuario autenticado
 * dentro del sistema (NO la administración global de usuarios).
 *
 * RESPONSABILIDADES PRINCIPALES:
 * - Mostrar el formulario de edición del perfil
 * - Actualizar los datos personales del usuario autenticado
 * - Eliminar la cuenta del usuario de forma segura
 *
 * DIFERENCIA CON UserController:
 * - ProfileController: gestiona el perfil del usuario logueado
 * - UserController: gestiona todos los usuarios (panel admin)
*/

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición del perfil del usuario autenticado.
    */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Actualizar la información del perfil del usuario autenticado.
    */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        // Si el email fue modificado, se invalida la verificación
        // (medida de seguridad estándar en Laravel)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Redirige al perfil con mensaje de éxito
        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Eliminar la cuenta del usuario autenticado de forma segura.
    */
    public function destroy(Request $request): RedirectResponse
    {
        // Validación de contraseña actual (seguridad crítica)
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        // Invalida completamente la sesión actual
        $request->session()->invalidate();

        // Regenera el token CSRF para evitar ataques
        $request->session()->regenerateToken();

        // Redirige a la página de inicio del sistema
        return Redirect::to('/');
    }
}
