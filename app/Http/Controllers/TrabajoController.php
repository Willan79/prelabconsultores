<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Imagen;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Services\TrabajoService;

/**
 * Controlador encargado de la gestión de trabajos.
 *
 * Este controlador maneja todas las operaciones CRUD relacionadas
 * con los trabajos del sistema, incluyendo:
 * - Listado de trabajos
 * - Creación de trabajos con imágenes
 * - Visualización de trabajos
 * - Edición y actualización
 * - Eliminación de trabajos
 * - Eliminación de imágenes asociadas
 *
 * ARQUITECTURA:
 * - Utiliza el patrón Service Layer (TrabajoService)
 * - Mantiene el controlador limpio delegando la lógica de negocio
 * - Sigue principios SOLID (Responsabilidad Única)
 *
 * RELACIONES:
 * - Trabajo pertenece a una Empresa
 * - Trabajo puede tener múltiples Imágenes
 */
class TrabajoController extends Controller
{
    /**
     * Servicio encargado de la lógica de negocio de trabajos.
    */
    protected $trabajoService;

    /**
     * Constructor del controlador.
     * Inyecta el servicio TrabajoService mediante
     * inyección de dependencias.
     *
     */
    public function __construct(TrabajoService $trabajoService)
    {
        $this->trabajoService = $trabajoService;
    }

    /**
     * Mostrar la lista de todos los trabajos registrados.
     *
     * Carga los trabajos junto con su empresa asociada.
    */
    public function index()
    {
        $trabajos = $this->trabajoService->listarTrabajos();
        return view('trabajos.index', compact('trabajos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo trabajo.
     *
     * Obtiene todas las empresas para asociarlas al trabajo.
    */
    public function create()
    {
        $empresas = Empresa::all();
        return view('trabajos.create', compact('empresas'));
    }

    /**
     * Almacenar un nuevo trabajo en la base de datos.
     *
     * Valida los datos del formulario y las imágenes subidas
     * antes de enviarlos al servicio para su procesamiento.
    */
    public function store(Request $request)
    {
        // Validación de datos
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id',
            'imagens.*' => 'image|max:2048',
        ]);

        $this->trabajoService->crearTrabajo($data, $request->file('imagens'));

        return redirect()->route('trabajos.index')
            ->with('success', 'Trabajo registrado correctamente.');
    }

    /**
     * Mostrar los detalles de un trabajo específico.
    */
    public function show($id)
    {
        $trabajo = Trabajo::with('empresa')->findOrFail($id);
        return view('trabajos.show', compact('trabajo'));
    }

    /**
     * Mostrar el formulario de edición de un trabajo.
    */
    public function edit($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $empresas = Empresa::all();

        return view('trabajos.edit', compact('trabajo', 'empresas'));
    }

    /**
     * Actualizar un trabajo existente.
    */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id',
            'imagens.*' => 'image|max:2048',
        ]);

        $trabajo = Trabajo::findOrFail($id);

        $this->trabajoService->actualizarTrabajo(
            $trabajo,
            $data,
            $request->file('imagens')
        );

        return redirect()->route('trabajos.show', $trabajo->id)
            ->with('success', 'Trabajo actualizado correctamente.');
    }

    /**
     * Eliminar un trabajo y sus imágenes asociadas.
    */
    public function destroy($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $this->trabajoService->eliminarTrabajo($trabajo);

        return redirect()->route('trabajos.index')
            ->with('success', 'Trabajo eliminado correctamente.');
    }

    /**
     * Eliminar una imagen específica asociada a un trabajo.
     *
     * Elimina tanto el archivo físico del almacenamiento
     * como el registro en la base de datos.
    */
    public function destroyImagen($id)
    {
        $imagen = Imagen::findOrFail($id);
        $this->trabajoService->eliminarImagen($imagen);

        return back()->with('success', 'Imagen eliminada correctamente.');
    }
}
