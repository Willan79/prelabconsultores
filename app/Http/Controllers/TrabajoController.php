<?php

namespace app\Http\Controllers;

use app\Models\Trabajo;
use app\Models\Imagen;
use app\Models\Empresa;
use Illuminate\Http\Request;
use app\Services\TrabajoService;

class TrabajoController extends Controller
{
    //TODO Servicio para manejar la lógica de negocios relacionada con trabajos
    protected $trabajoService;

    //TODO Inyectar el servicio TrabajoService
    public function __construct(TrabajoService $trabajoService)
    {
        $this->trabajoService = $trabajoService;
    }

    //TODO Listar todos los trabajos
    public function index()
    {
        $trabajos = $this->trabajoService->listarTrabajos();
        return view('trabajos.index', compact('trabajos'));
    }
    //TODO Mostrar el formulario para crear un nuevo trabajo
    public function create()
    {
        $empresas = Empresa::all();
        return view('trabajos.create', compact('empresas'));
    }
    //TODO Almacenar un nuevo trabajo
    public function store(Request $request)
    {
        //Validación
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id',
            'imagens.*' => 'image|max:2048',
        ]);

        $this->trabajoService->crearTrabajo($data, $request->file('imagens'));

        return redirect()->route('trabajos.index')->with('success', 'Trabajo registrado correctamente.');
    }
    //TODO Mostrar un trabajo específico
    public function show($id)
    {
        $trabajo = Trabajo::with('empresa')->findOrFail($id);
        return view('trabajos.show', compact('trabajo'));
    }
    //TODO Mostrar el formulario para editar un trabajo existente
    public function edit($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $empresas = Empresa::all();
        return view('trabajos.edit', compact('trabajo', 'empresas'));
    }
    //TODO Actualizar un trabajo existente
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id',
            'imagens.*' => 'image|max:2048',
        ]);

        $trabajo = Trabajo::findOrFail($id);
        $this->trabajoService->actualizarTrabajo($trabajo, $data, $request->file('imagens'));

        return redirect()->route('trabajos.show', $trabajo->id)->with('success', 'Trabajo actualizado correctamente.');
    }
    //TODO Eliminar un trabajo y sus imágenes asociadas
    public function destroy($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $this->trabajoService->eliminarTrabajo($trabajo);

        return redirect()->route('trabajos.index')->with('success', 'Trabajo eliminado correctamente.');
    }
    //TODO Eliminar una imagen específica asociada a un trabajo
    public function destroyImagen($id)
    {
        $imagen = Imagen::findOrFail($id);
        $this->trabajoService->eliminarImagen($imagen);

        return back()->with('success', 'Imagen eliminada correctamente.');
    }
}
