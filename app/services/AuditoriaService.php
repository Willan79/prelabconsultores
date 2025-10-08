<?php

namespace app\Services;

use app\Models\Auditoria;

class AuditoriaService
{
    public function listarAuditorias() //TODO Listar todas las auditorías
    {
        return Auditoria::with(['empresa', 'user'])->paginate(6);// Paginación de 10 por página
    }

    public function crearAuditoria(array $data) //TODO Crear una nueva auditoría
    {
        return Auditoria::create($data);
    }

    public function obtenerAuditoria($id)//TODO Obtener una auditoría por su ID
    {
        return Auditoria::with(['empresa', 'user'])->findOrFail($id);
    }

    public function actualizarAuditoria($id, array $data)//TODO Actualizar una auditoría existente
    {
        $auditoria = Auditoria::findOrFail($id);
        $auditoria->update($data);
        return $auditoria;
    }

    public function eliminarAuditoria($id)//TODO Eliminar una auditoría
    {
        $auditoria = Auditoria::findOrFail($id);
        $auditoria->delete();
        return true;
    }
}
