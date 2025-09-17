<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    //TODO Listar todos los usuarios
    public function index()
    {
        $usuarios = $this->userService->obtenerTodos();
        return view('admin.tabla_user', compact('usuarios'));
    }
    //TODO Editar rol de usuario
    public function edit($id)
    {
        $usuario = $this->userService->obtenerPorId($id);
        return view('admin.usuarios_edit', compact('usuario'));
    }
    //TODO Actualizar rol de usuario
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,consultor,cliente',
        ]);

        $this->userService->actualizarRol($id, $request->role);

        return redirect()->route('tabla_user')
            ->with('success', 'Rol actualizado correctamente.');
    }
    //TODO Eliminar usuario
    public function destroy($id)
    {
        $this->userService->eliminar($id);

        return redirect()->route('tabla_user')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
