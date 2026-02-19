<?php

namespace App\Services;

use App\Models\Auditoria;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Servicio de Auditorías
 * ------------------------------------------------------
 * Esta clase gestiona toda la lógica de negocio relacionada
 * con las auditorías del sistema.
 *
 * RESPONSABILIDADES:
 * - Listar auditorías con relaciones (empresa y usuario)
 * - Crear nuevas auditorías
 * - Obtener auditorías por ID
 * - Actualizar auditorías existentes
 * - Eliminar auditorías
 *
 */
class AuditoriaService
{
    /**
     * Relaciones que se cargan por defecto para optimizar consultas.
     * Evita múltiples consultas a la base de datos (N+1 problem).
     */
    private const RELATIONS = ['empresa', 'user'];

    /**
     * Listar auditorías con paginación y relaciones.
     *
     * @param int $porPagina Cantidad de registros por página
     * @return LengthAwarePaginator
     */
    public function listarAuditorias(int $porPagina = 6): LengthAwarePaginator
    {
        return Auditoria::with(self::RELATIONS)
            ->latest() // Ordena por las más recientes (created_at)
            ->paginate($porPagina);
    }

    /**
     * Crear una nueva auditoría.
     *
     * @param array $data Datos validados desde el controlador
     * @return Auditoria
     */
    public function crearAuditoria(array $data): Auditoria
    {
        return Auditoria::create($data);
    }

    /**
     * Obtener una auditoría por su ID con relaciones.
     *
     * @param int $id
     * @return Auditoria
     */
    public function obtenerAuditoria(int $id): Auditoria
    {
        return Auditoria::with(self::RELATIONS)->findOrFail($id);
    }

    /**
     * Actualizar una auditoría existente.
     *
     * @param int $id ID de la auditoría
     * @param array $data Datos validados
     * @return Auditoria
     */
    public function actualizarAuditoria(int $id, array $data): Auditoria
    {
        $auditoria = Auditoria::findOrFail($id);
        $auditoria->update($data);

        // Recarga relaciones para mantener consistencia
        return $auditoria->load(self::RELATIONS);
    }

    /**
     * Eliminar una auditoría del sistema.
     *
     * @param int $id
     * @return bool
     */
    public function eliminarAuditoria(int $id): bool
    {
        $auditoria = Auditoria::findOrFail($id);
        return $auditoria->delete();
    }
}
