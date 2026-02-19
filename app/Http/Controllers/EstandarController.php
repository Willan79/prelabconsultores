<?php

namespace App\Http\Controllers;

use App\Services\EstandarService;
use Illuminate\Http\Request;

/**
 * Controlador encargado de la gestión de estándares por empresa.
 *
 * Este controlador maneja las operaciones relacionadas con:
 * - Listado de estándares (admin y cliente)
 * - Subida de archivos de estándares
 * - Descarga de estándares
 * - Eliminación de estándares
 *
 * Utiliza el patrón Service Layer delegando la lógica de negocio
 * al EstandarService para mantener el controlador limpio y organizado.
*/

class EstandarController extends Controller
{
    /**
     * Instancia del servicio de estándares.
     *
     * @var EstandarService
     */
    protected $estandarService;

    public function __construct(EstandarService $estandarService)
    {
        $this->estandarService = $estandarService;
    }

    /**
     * Mostrar la lista de estándares de una empresa específica (vista administrador).
    */
    public function index($empresa_id)
    {
        $data = $this->estandarService->obtenerPorEmpresa($empresa_id);
        return view('admin.estandares', $data);
    }

    /**
     * Mostrar los estándares del cliente autenticado.
     * Verifica que el usuario tenga una empresa asociada antes de mostrar los datos.
    */
    public function indexCliente()
    {
        $data = $this->estandarService->obtenerPorUsuario(auth()->user());

        if (!$data) {
            return redirect()->back()->with('error', 'No tienes una empresa asociada.');
        }

        return view('empresas.estandares', $data);
    }

    /**
     * Subir un nuevo archivo de estándar para una empresa.
    */
    public function store(Request $request, $empresa_id)
    {
        $request->validate([
            'estandar' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,png|max:10240',
        ]);

        $this->estandarService->subirArchivo($request, $empresa_id, auth()->id());

        return redirect()->back()->with('success', 'Estándar subido correctamente.');
    }

    /**
     * Descargar un estándar para el cliente autenticado.
     *
     * Maneja excepciones en caso de acceso no autorizado o archivo inexistente.
    */
    public function descargarCliente($empresaId, $id)
    {
        try {
            return $this->estandarService->descargar($empresaId, $id, auth()->user());
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Descargar un estándar (modo administrador).
    */
    public function descargar($empresa_id, $id)
    {
        try {
            return $this->estandarService->descargar($empresa_id, $id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Eliminar un estándar asociado a una empresa.
    */
    public function destroy($empresa_id, $id)
    {
        $this->estandarService->eliminar($empresa_id, $id);

        return redirect()->back()->with('success', 'Estándar eliminado correctamente.');
    }
}
