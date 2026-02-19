<?php

/*
|--------------------------------------------------------------------------
| Servicio: EstandarService
|--------------------------------------------------------------------------
| Capa de lógica de negocio para la gestión de estándares/documentos.
|
| Responsabilidades:
| - Obtener estándares por empresa o por usuario autenticado
| - Gestionar subida de archivos al storage público
| - Controlar descargas seguras de documentos
| - Eliminar registros y archivos físicos asociados
|--------------------------------------------------------------------------
*/

namespace App\Services;

use App\Models\Estandar;
use App\Models\Empresa;
use Illuminate\Support\Facades\Storage;

class EstandarService
{
    // Obtener estándares por empresa
    public function obtenerPorEmpresa($empresa_id)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $estandares = Estandar::where('empresa_id', $empresa_id)->get();
        return compact('empresa', 'estandares');
    }
    // Obtener estándares para el usuario autenticado
    public function obtenerPorUsuario($user)
    {
        $empresa = $user->empresa;
        if (!$empresa) {
            return null;
        }
        $estandares = Estandar::where('empresa_id', $empresa->id)->get();
        return compact('empresa', 'estandares');
    }
    // Subir un nuevo estándar
    public function subirArchivo($request, $empresa_id, $user_id)
    {
        $archivo = $request->file('estandar');
        $nombreOriginal = $archivo->getClientOriginalName();
        $ruta = $archivo->store('documentos', 'public');

        return Estandar::create([
            'empresa_id' => $empresa_id,
            'nombre' => $nombreOriginal,
            'archivo' => $ruta,
            'user_id' => $user_id,
        ]);
    }
    // Descargar un estándar
    public function descargar($empresa_id, $id, $user = null)
    {
        $query = Estandar::where('empresa_id', $empresa_id);// Si $empresa_id es null, no se filtra por empresa
        if ($user && $user->empresa) {
            $query->where('empresa_id', $user->empresa->id);
        }

        $estandar = $query->findOrFail($id);// Si no se encuentra, lanza una excepción 404

        if (!$estandar->archivo) {// Si no tiene archivo asociado, lanza una excepción
            throw new \Exception('El estándar no tiene archivo asociado.');
        }

        $ruta = 'public/' . $estandar->archivo; // Ruta completa en el almacenamiento
        if (!Storage::exists($ruta)) {// Si el archivo no existe en el almacenamiento, lanza una excepción
            throw new \Exception('El archivo no se encuentra en el almacenamiento.');
        }

        return Storage::download($ruta, $estandar->nombre); // Descarga el archivo con el nombre original
    }
    // Eliminar un estándar
    public function eliminar($empresa_id, $id)
    {
        $estandar = Estandar::where('empresa_id', $empresa_id)->findOrFail($id);

        if ($estandar->archivo && Storage::exists('public/' . $estandar->archivo)) { // Elimina el archivo del almacenamiento si existe
            Storage::delete('public/' . $estandar->archivo);
        }

        return $estandar->delete();
    }
}
