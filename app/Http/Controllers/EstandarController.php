<?php

namespace app\Http\Controllers;

use app\Services\EstandarService;
use Illuminate\Http\Request;

class EstandarController extends Controller
{
    protected $estandarService;

    public function __construct(EstandarService $estandarService)
    {
        $this->estandarService = $estandarService;
    }
    //TODO Listar estándares por empresa
    public function index($empresa_id)
    {
        $data = $this->estandarService->obtenerPorEmpresa($empresa_id);
        return view('admin.estandares', $data);
    }
    //TODO Listar estándares para el cliente autenticado
    public function indexCliente()
    {
        $data = $this->estandarService->obtenerPorUsuario(auth()->user());
        if (!$data) {
            return redirect()->back()->with('error', 'No tienes una empresa asociada.');
        }
        return view('empresas.estandares', $data);
    }
    //TODO Subir un nuevo estándar
    public function store(Request $request, $empresa_id)
    {
        $request->validate([
            'estandar' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,png|max:10240',
        ]);

        $this->estandarService->subirArchivo($request, $empresa_id, auth()->id());
        return redirect()->back()->with('success', 'Estándar subido correctamente.');
    }
    //TODO Descargar un estándar (para clientes autenticados)
    public function descargarCliente($empresaId, $id)
    {
        try {
            return $this->estandarService->descargar($empresaId, $id, auth()->user());
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    //TODO Descargar un estándar (para administradores)
    public function descargar($empresa_id, $id)
    {
        try {
            return $this->estandarService->descargar($empresa_id, $id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    //TODO Eliminar un estándar
    public function destroy($empresa_id, $id)
    {
        $this->estandarService->eliminar($empresa_id, $id);
        return redirect()->back()->with('success', 'Estándar eliminado correctamente.');
    }
}
