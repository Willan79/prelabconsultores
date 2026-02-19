<?php

/*
|--------------------------------------------------------------------------
| Service: EmpresaService
|--------------------------------------------------------------------------
| Responsabilidad:
| Contiene la lógica de negocio relacionada con el modelo Empresa.
| Actúa como capa intermedia entre el controlador y el modelo.
|
| Beneficios:
| - Centraliza la lógica de negocio, facilitando el mantenimiento y la escalabilidad.
|--------------------------------------------------------------------------
 */

namespace App\Services;

use App\Models\Empresa;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmpresaService
{
    /**
     * Listar empresas con paginación
     */
    public function listarEmpresas(int $porPagina = 7): LengthAwarePaginator
    {
        return Empresa::paginate($porPagina);
    }

    /**
     * Crear nueva empresa
     */
    public function crearEmpresa(array $data): Empresa // El tipo de retorno es el modelo Empresa creado
    {
        return Empresa::create($data);
    }

    /**
     * Obtener empresa por ID
     */
    public function obtenerEmpresa(int $id): Empresa
    {
        return Empresa::findOrFail($id);
    }

    /**
     * Actualizar empresa existente
     */
    public function actualizarEmpresa(int $id, array $data): Empresa
    {
        $empresa = $this->obtenerEmpresa($id);
        $empresa->update($data);

        return $empresa;
    }

    /**
     * Eliminar empresa
     */
    public function eliminarEmpresa(int $id): bool // Retorna true si la eliminación fue exitosa
    {
        $empresa = $this->obtenerEmpresa($id);

        return $empresa->delete();
    }
}
