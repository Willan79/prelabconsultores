<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Controlador encargado de la gestión de usuarios del sistema.
 *
 * Este controlador administra las operaciones relacionadas con
 * los usuarios, especialmente desde el panel administrativo:
 * - Listado de usuarios
 * - Edición de roles
 * - Actualización de roles
 * - Eliminación de usuarios
 *
 * ARQUITECTURA:
 * - Implementa el patrón Service Layer mediante UserService
 * - Mantiene el controlador ligero (Thin Controller)
 * - Delegación de la lógica de negocio al servicio
 *
 * SEGURIDAD:
 * - Validación estricta de roles permitidos
 * - Uso de findOrFail desde el servicio (evita usuarios inexistentes)
 * - Protección contra asignación masiva indebida
*/
class UserController extends Controller
{
    /**
     * Servicio encargado de la lógica de negocio de usuarios.
    */
    protected $userService;

    /**
     * Constructor del controlador.
     * Inyecta el servicio UserService mediante
     * inyección de dependencias.
    */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Mostrar la lista paginada de todos los usuarios.
     *
     * Obtiene los usuarios desde el servicio con paginación
     * para optimizar el rendimiento en el panel administrativo.
    */
    public function index()
    {
        $usuarios = $this->userService->obtenerTodos();
        return view('admin.tabla_user', compact('usuarios'));
    }

    /**
     * Mostrar el formulario de edición de rol de un usuario.
     *
     * Busca el usuario por su ID y lo envía a la vista
     * de edición en el panel administrativo.
    */
    public function edit($id)
    {
        $usuario = $this->userService->obtenerPorId($id);
        return view('admin.usuarios_edit', compact('usuario'));
    }

    /**
     * Actualizar el rol de un usuario existente.
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,consultor,cliente',
        ]);

        $this->userService->actualizarRol($id, $request->role);

        return redirect()->route('tabla_user')
            ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Eliminar un usuario del sistema.
     *
     * Busca el usuario por su ID y delega la eliminación
     * al servicio de usuarios.
    */
    public function destroy($id)
    {
        $this->userService->eliminar($id);

        return redirect()->route('tabla_user')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
