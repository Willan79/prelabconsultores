<?php

namespace app\Http\Controllers;

use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Services\EmpresaService;

class EmpresaController extends Controller
{
    protected $empresaService;

    public function __construct(EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
    }

    public function index() //TODO Listar todas las empresas
    {
        $empresas = $this->empresaService->listarEmpresas();
        return view('admin.tabla_empresas', compact('empresas'));
    }

    public function create() //TODO Mostrar formulario para crear una nueva empresa
    {
        $usuarios = User::all();
        return view('admin.nueva_empresa', compact('usuarios'));
    }

    public function store(Request $request) //TODO Almacenar una nueva empresa
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'nit' => 'required|string|max:20|unique:empresas',
            'razon_social' => 'required|string|max:255',
            'num_trabajadores' => 'required|integer|min:1',
            'ciudad' => 'required|string|min:3',
            'direccion' => 'required|string|max:250',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $this->empresaService->crearEmpresa($data);

        return redirect()->route('tabla_empresas')->with('success', 'Empresa registrada con éxito.');
    }

    //TODO Mostrar detalles de una empresa específica
    public function show($id)
    {
        $empresa = $this->empresaService->obtenerEmpresa($id);
        return view('empresas.show', compact('empresa'));
    }

    public function edit($id) //TODO Mostrar formulario para editar una empresa existente
    {
        $usuarios = User::all();
        $empresa = $this->empresaService->obtenerEmpresa($id);

        return view('admin.empresa_edit', compact('empresa', 'usuarios'));
    }

    public function update(Request $request, $id) //TODO Actualizar una empresa existente
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'nit' => 'required|string|max:20|unique:empresas,nit,' . $id,
            'razon_social' => 'required|string|max:255',
            'num_trabajadores' => 'required|integer|min:1',
            'ciudad' => 'required|string|max:200',
            'direccion' => 'required|string|max:2500',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $this->empresaService->actualizarEmpresa($id, $data);

        return redirect()->route('tabla_empresas')->with('success', 'Empresa actualizada correctamente.');
    }

    public function showEmpresaCliente() //TODO Mostrar la empresa asociada al usuario autenticado
    {
        $empresa = Auth::user()->empresa;
        if (!$empresa) { // Si el usuario no tiene una empresa asociada
            return redirect()->back()->with('success', 'No tienes una empresa asignada.');
        }
        return view('empresas.show', compact('empresa'));
    }


    public function destroy($id) //TODO Eliminar una empresa
    {
        $this->empresaService->eliminarEmpresa($id);
        return redirect()->route('tabla_empresas')->with('success', 'Empresa eliminada correctamente.');
    }
}
