<?php

/*

| Controller: AuditoriaController
|--------------------------------------------------------------------------
| Responsabilidad:
| Gestiona el ciclo completo de las auditorías (CRUD) delegando la lógica
| de negocio al servicio AuditoriaService.
|
| Arquitectura:
| - Controlador delgado (Thin Controller)
| - Lógica en Service Layer
|
|--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Services\AuditoriaService;

class AuditoriaController extends Controller
{
    protected AuditoriaService $auditoriaService;

    public function __construct(AuditoriaService $auditoriaService)
    {
        $this->auditoriaService = $auditoriaService;
    }

    /** Listar auditorías */
    public function index()
    {
        $auditorias = $this->auditoriaService->listarAuditorias();
        return view('admin.auditorias', compact('auditorias'));
    }

    /** Mostrar formulario de creación */
    public function create()
    {
        return view('admin.auditoria_crear', [
            'empresas' => Empresa::all(),
            'users' => User::whereIn('role', ['consultor', 'admin'])->get()
        ]);
    }

    /** Guardar auditoría */
    public function store(Request $request)
    {
        $data = $this->validar($request);

        $this->auditoriaService->crearAuditoria($data);

        return redirect()
            ->route('auditorias')
            ->with('success', 'Auditoría creada correctamente.');
    }

    /** Ver detalle */
    public function show(int $id)
    {
        $auditoria = $this->auditoriaService->obtenerAuditoria($id);
        return view('admin.auditoria_ver', compact('auditoria'));
    }

    /** Formulario edición */
    public function edit(int $id)
    {
        return view('admin.auditoria_edit', [
            'auditoria' => $this->auditoriaService->obtenerAuditoria($id),
            'empresas' => Empresa::all(),
            'users' => User::whereIn('role', ['consultor', 'admin'])->get()
        ]);
    }

    /** Actualizar */
    public function update(Request $request, int $id)
    {
        $data = $this->validar($request);

        $this->auditoriaService->actualizarAuditoria($id, $data);

        return redirect()
            ->route('auditorias')
            ->with('success', 'Auditoría actualizada correctamente.');
    }

    /** Eliminar */
    public function destroy(int $id)
    {
        $this->auditoriaService->eliminarAuditoria($id);

        return redirect()
            ->route('auditorias')
            ->with('success', 'Auditoría eliminada correctamente.');
    }

    /** Validación */
    private function validar(Request $request): array
    {
        return $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_proceso,finalizada',
        ]);
    }
}
