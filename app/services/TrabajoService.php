<?php

namespace App\Services;

use App\Models\Trabajo;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;

class TrabajoService
{
    //TODO Listar todos los trabajos
    public function listarTrabajos()
    {
        return Trabajo::with('empresa')->latest()->get(); // Obtener todos los trabajos con la empresa asociada
    }
    //TODO Crear un nuevo trabajo
    public function crearTrabajo(array $data, $imagenes = null)
    {
        $trabajo = Trabajo::create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'empresa_id' => $data['empresa_id'],
        ]);

        if ($imagenes) { // Guardar las imágenes si fueron subidas
            $this->guardarImagenes($trabajo, $imagenes);
        }

        return $trabajo;
    }

    //TODO Actualizar un trabajo existente
    public function actualizarTrabajo(Trabajo $trabajo, array $data, $imagenes = null)
    {
        $trabajo->update([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'empresa_id' => $data['empresa_id'],
        ]);

        if ($imagenes) {
            $this->guardarImagenes($trabajo, $imagenes);
        }

        return $trabajo;
    }
    //TODO Eliminar un trabajo y sus imágenes asociadas
    public function eliminarTrabajo(Trabajo $trabajo)
    {
        $trabajo->delete();
    }
    //TODO Eliminar una imagen específica asociada a un trabajo
    public function eliminarImagen(Imagen $imagen)
    {
        Storage::disk('public')->delete($imagen->ruta);
        $imagen->delete();
    }
    //TODO Guardar imágenes asociadas a un trabajo
    private function guardarImagenes(Trabajo $trabajo, $imagenes)
    {
        foreach ($imagenes as $imagen) {
            $path = $imagen->store('trabajos', 'public');
            $trabajo->imagens()->create(['ruta' => $path]);
        }
    }
}
