<?php

namespace App\Services;

use App\Models\Empresa;

class EmpresaService
{
    public function listarEmpresas($porPagina = 7) //TODO Listar todas las empresas
    {
        return Empresa::paginate($porPagina);
    }

    public function crearEmpresa(array $data) //TODO Crear una nueva empresa
    {
        return Empresa::create($data);
    }

    public function obtenerEmpresa($id) //TODO Obtener una empresa por su ID
    {
        return Empresa::findOrFail($id);
    }

    public function actualizarEmpresa($id, array $data) //TODO Actualizar una empresa existente
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->update($data);
        return $empresa;
    }

    public function eliminarEmpresa($id) //TODO Eliminar una empresa
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return true;
    }
}
