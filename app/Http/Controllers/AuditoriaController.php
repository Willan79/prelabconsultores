<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Services\AuditoriaService;

class AuditoriaController extends Controller
{
    protected $auditoriaService;

    public function __construct(AuditoriaService $auditoriaService)
    {
        $this->auditoriaService = $auditoriaService;
    }

    // Mostrar lista de auditorías
    public function index()
    {
        $auditorias = $this->auditoriaService->listarAuditorias();
        return view('admin.auditorias', compact('auditorias'));
    }

    // Mostrar formulario para crear auditoría
    public function create()
    {
        $empresas = Empresa::all();
        $users = User::whereIn('role', ['consultor', 'admin'])->get();
        return view('admin.auditoria_crear', compact('empresas', 'users'));
    }

    // Almacenar nueva auditoría
    public function store(Request $request)
    {
        $data = $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_proceso,finalizada',
        ]);

        $this->auditoriaService->crearAuditoria($data);

        return redirect()->route('auditorias')->with('success', 'Auditoría creada correctamente.');
    }

    // Mostrar una auditoría específica
    public function show($id)
    {
        $auditoria = $this->auditoriaService->obtenerAuditoria($id);
        return view('admin.auditoria_ver', compact('auditoria'));
    }

    // Mostrar formulario para editar auditoría
    public function edit($id)
    {
        $auditoria = $this->auditoriaService->obtenerAuditoria($id);
        $empresas = Empresa::all();
        $users = User::whereIn('role', ['consultor', 'admin'])->get();

        return view('admin.auditoria_edit', compact('auditoria', 'empresas', 'users'));
    }

    // Actualizar auditoría
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_proceso,finalizada',
        ]);

        $this->auditoriaService->actualizarAuditoria($id, $data);

        return redirect()->route('auditorias')->with('success', 'Auditoría actualizada correctamente.');
    }

    // Eliminar auditoría
    public function destroy($id)
    {
        $this->auditoriaService->eliminarAuditoria($id);

        return redirect()->route('auditorias.index')->with('success', 'Auditoría eliminada correctamente.');
    }
}
