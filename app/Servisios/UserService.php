<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    //TODO Obtener todos los usuarios
    public function obtenerTodos($porPagina = 6)
    {
        return User::paginate($porPagina);
    }
    //TODO Obtener usuario por ID
    public function obtenerPorId($id)
    {
        return User::findOrFail($id);
    }
    //TODO Actualizar rol de usuario
    public function actualizarRol($id, $role)
    {
        $usuario = User::findOrFail($id);
        $usuario->role = $role;
        $usuario->save();
        return $usuario;
    }
    //TODO Eliminar usuario
    public function eliminar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return true;
    }
}
