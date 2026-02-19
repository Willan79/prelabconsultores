<?php

/**
 * Servicio de Trabajos (TrabajoService)
 * ------------------------------------------------------
 * Este servicio encapsula toda la lógica de negocio relacionada
 * con la gestión de trabajos y sus imágenes asociadas.
 *
 * RESPONSABILIDADES:
 * - Listar trabajos con sus relaciones (empresa)
 * - Crear trabajos con carga múltiple de imágenes
 * - Actualizar trabajos y gestionar nuevas imágenes
 * - Eliminar trabajos junto con sus archivos almacenados
 * - Eliminar imágenes individuales de forma segura
 *
 * SEGURIDAD:
 * - Uso del disco 'public' controlado por Laravel
 * - Eliminación física del archivo antes de borrar el registro
 * - Evita archivos huérfanos en el almacenamiento
 */

namespace App\Services;

use App\Models\Trabajo;
use App\Models\Imagen;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TrabajoService
{
    /**
     * Listar todos los trabajos con su empresa asociada.
     * Utiliza Eager Loading para evitar el problema N+1.
     *
     * @return Collection
     */
    public function listarTrabajos(): Collection
    {
        return Trabajo::with('empresa')
            ->latest()
            ->get();
    }

    /**
     * Crear un nuevo trabajo con imágenes opcionales.
     *
     * @param array $data Datos validados del formulario
     * @param UploadedFile[]|null $imagenes Arreglo de imágenes subidas
     * @return Trabajo
     */
    public function crearTrabajo(array $data, ?array $imagenes = null): Trabajo
    {
        // Creación del trabajo
        $trabajo = Trabajo::create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'empresa_id' => $data['empresa_id'],
        ]);

        // Guardar imágenes si existen
        if (!empty($imagenes)) { 
            $this->guardarImagenes($trabajo, $imagenes);
        }

        return $trabajo;
    }

    /**
     * Actualizar un trabajo existente y añadir nuevas imágenes si se proporcionan.
     *
     * @param Trabajo $trabajo Instancia del modelo Trabajo
     * @param array $data Datos validados
     * @param UploadedFile[]|null $imagenes Nuevas imágenes a subir
     * @return Trabajo
     */
    public function actualizarTrabajo(Trabajo $trabajo, array $data, ?array $imagenes = null): Trabajo
    {
        // Actualización de datos principales
        $trabajo->update([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'empresa_id' => $data['empresa_id'],
        ]);

        // Guardar nuevas imágenes si fueron enviadas
        if (!empty($imagenes)) {
            $this->guardarImagenes($trabajo, $imagenes);
        }

        return $trabajo;
    }

    /**
     * Eliminar un trabajo junto con todas sus imágenes asociadas
     * (registro en BD + archivos físicos en storage).
     *
     * @param Trabajo $trabajo
     * @return void
     */
    public function eliminarTrabajo(Trabajo $trabajo): void
    {
        // Eliminar archivos físicos de las imágenes asociadas
        foreach ($trabajo->imagens as $imagen) {
            if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
                Storage::disk('public')->delete($imagen->ruta);
            }
        }

        // Eliminar registros de imágenes (relación)
        $trabajo->imagens()->delete();

        // Finalmente eliminar el trabajo
        $trabajo->delete();
    }

    /**
     * Eliminar una imagen específica asociada a un trabajo.
     *
     * @param Imagen $imagen
     * @return void
     */
    public function eliminarImagen(Imagen $imagen): void
    {
        // Eliminar archivo físico si existe
        if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
            Storage::disk('public')->delete($imagen->ruta);
        }

        // Eliminar registro en la base de datos
        $imagen->delete();
    }

    /**
     * Guardar múltiples imágenes asociadas a un trabajo.
     * Método privado para mantener la lógica encapsulada.
     *
     * @param Trabajo $trabajo
     * @param UploadedFile[] $imagenes
     * @return void
     */
    private function guardarImagenes(Trabajo $trabajo, array $imagenes): void
    {
        foreach ($imagenes as $imagen) {
            // Almacenar archivo en el disco público
            $path = $imagen->store('trabajos', 'public');

            // Crear registro de la imagen asociada al trabajo
            $trabajo->imagens()->create([
                'ruta' => $path
            ]);
        }
    }
}
