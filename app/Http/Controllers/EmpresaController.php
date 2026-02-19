<?php

/*
|--------------------------------------------------------------------------
| Controller: EmpresaController
|--------------------------------------------------------------------------
| Responsabilidad:
| Gestiona el ciclo CRUD de Empresas delegando la lógica de negocio
| al servicio EmpresaService.
|
| Arquitectura aplicada:
| - Patrón MVC
| - Service Layer (Thin Controller)
| - Validación centralizada
|--------------------------------------------------------------------------
*/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\EmpresaService;

class EmpresaController extends Controller
{
    protected EmpresaService $empresaService;

    public function __construct(EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
    }

    /** Listar todas las empresas */
    public function index()
    {
        $empresas = $this->empresaService->listarEmpresas();
        return view('admin.tabla_empresas', compact('empresas'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {
        return view('admin.nueva_empresa', [
            'usuarios' => User::all()
        ]);
    }

    /** Guardar nueva empresa */
    public function store(Request $request)
    {
        $data = $this->validar($request);

        $this->empresaService->crearEmpresa($data);

        return redirect()
            ->route('tabla_empresas')
            ->with('success', 'Empresa registrada con éxito.');
    }

    /** Mostrar detalle de una empresa */
    public function show(int $id)
    {
        $empresa = $this->empresaService->obtenerEmpresa($id);
        return view('empresas.show', compact('empresa'));
    }

    /** Mostrar formulario de edición */
    public function edit(int $id)
    {
        return view('admin.empresa_edit', [
            'empresa' => $this->empresaService->obtenerEmpresa($id),
            'usuarios' => User::all()
        ]);
    }

    /** Actualizar empresa */
    public function update(Request $request, int $id)
    {
        $data = $this->validar($request, $id);

        $this->empresaService->actualizarEmpresa($id, $data);

        return redirect()
            ->route('tabla_empresas')
            ->with('success', 'Empresa actualizada correctamente.');
    }

    /** Mostrar empresa asociada al usuario autenticado */
    public function showEmpresaCliente()
    {
        // Obtener la empresa asociada al usuario autenticado
        $empresa = Auth::user()?->empresa;

        if (!$empresa) {
            return redirect()
                ->back()
                ->with('warning', 'No tienes una empresa asignada.');
        }

        return view('empresas.show', compact('empresa'));
    }

    /** Eliminar empresa */
    public function destroy(int $id)
    {
        $this->empresaService->eliminarEmpresa($id);

        return redirect()
            ->route('tabla_empresas')
            ->with('success', 'Empresa eliminada correctamente.');
    }

    /**
     * Validación centralizada
     * Permite reutilizar reglas en store y update
     */
    private function validar(Request $request, ?int $id = null): array // El ID es opcional para diferenciar entre creación y actualización
    {
        return $request->validate([
            'nombre' => 'required|string|max:255',
            'nit' => 'required|string|max:20|unique:empresas,nit,' . $id,
            'razon_social' => 'required|string|max:255',
            'num_trabajadores' => 'required|integer|min:1',
            'ciudad' => 'required|string|max:200',
            'direccion' => 'required|string|max:2500',
            'user_id' => 'nullable|exists:users,id',
        ]);
    }
}
