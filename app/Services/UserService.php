<?php

/**
 * Servicio de Usuarios (UserService)
 * ------------------------------------------------------
 * Este servicio centraliza toda la lógica de negocio
 * relacionada con la gestión de usuarios del sistema.
 *
 * RESPONSABILIDADES:
 * - Obtener usuarios paginados
 * - Buscar usuarios por ID
 * - Actualizar roles de usuario
 * - Eliminar usuarios de forma controlada
 *
 * ARQUITECTURA:
 * - Implementa el patrón Service Layer
 * - Desacopla la lógica de negocio del controlador
 * - Facilita mantenimiento y escalabilidad del sistema
 */

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * Obtener todos los usuarios de forma paginada.
     * Mejora el rendimiento en tablas grandes.
     *
     * @param int $porPagina Cantidad de registros por página
     * @return LengthAwarePaginator
     */
    public function obtenerTodos(int $porPagina = 6): LengthAwarePaginator
    {
        return User::latest()->paginate($porPagina);
    }

    /**
     * Obtener un usuario específico por su ID.
     * Lanza excepción 404 si no existe.
     *
     * @param int $id ID del usuario
     * @return User
     */
    public function obtenerPorId(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * Actualizar el rol de un usuario.
     * Centraliza la lógica de permisos y roles.
     *
     * @param int $id ID del usuario
     * @param string $role Nuevo rol (admin, consultor, cliente)
     * @return User
     */
    public function actualizarRol(int $id, string $role): User
    {
        $usuario = User::findOrFail($id);

        // Asignación del nuevo rol
        $usuario->role = $role;
        $usuario->save();

        return $usuario;
    }

    /**
     * Eliminar un usuario del sistema.
     * Puede ampliarse para eliminar relaciones asociadas.
     *
     * @param int $id ID del usuario
     * @return bool
     */
    public function eliminar(int $id): bool
    {
        $usuario = User::findOrFail($id);

        // Eliminación del usuario
        $usuario->delete();

        return true;
    }
}
