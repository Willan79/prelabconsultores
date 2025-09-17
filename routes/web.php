<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\EstandarController;
use App\Http\Controllers\AuditoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
Aquí puedes registrar rutas web para tu aplicación. Estas rutas son cargadas por RouteServiceProvider y todas se asignarán al grupo de middleware "web". ¡Crea algo increíble!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//! Pendiente las rutas
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/tabla_user', [UserController::class, 'index'])->name('tabla_user');
    Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios_edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    //!==============================================================================

    Route::get('/tabla_empresas', [EmpresaController::class, 'index'])->name('tabla_empresas');

    Route::get('/nueva_empresa', [EmpresaController::class, 'create'])->name('nueva_empresa');
    Route::post('/nueva_empresa', [EmpresaController::class, 'store'])->name('nueva_empresa');

    Route::get('empresa_edit/{id}/edit', [EmpresaController::class, 'edit'])->name('empresa_edit');
    Route::put('empresa_edit/{id}', [EmpresaController::class, 'update'])->name('empresa.update');
    Route::delete('/empresa/{id}', [EmpresaController::class, 'destroy'])->name('empresa.destroy');

    //!=================================================================================
    //
    Route::get('/auditorias', [AuditoriaController::class, 'index'])->name('auditorias');

    Route::get('/auditoria_crear', [AuditoriaController::class, 'create'])->name('auditoria_crear');

    Route::post('/auditoria_crear', [AuditoriaController::class, 'store'])->name('auditoria_crear');

    Route::get('/auditoria_edit/{id}/edit', [AuditoriaController::class, 'edit'])->name('auditorias_edit');

    Route::get('/auditorias/{id}', [AuditoriaController::class, 'show'])->name('auditoria_ver');

    Route::put('/auditorias/{auditoria}', [AuditoriaController::class, 'update'])->name('auditorias.update');

    Route::DELETE('/auditorias/{auditoria}', [AuditoriaController::class, 'destroy'])->name('auditorias.destroy');
    //

    //!=========================================================================================

    Route::prefix('empresas/{empresa}')->group(function () {
        Route::get('/estandares', [EstandarController::class, 'index'])->name('estandares');
        Route::get('/estandares/crear', [EstandarController::class, 'create'])->name('estandares.create');
        Route::post('/estandares', [EstandarController::class, 'store'])->name('estandares.store');
        Route::get('/estandares/{id}/descargar', [EstandarController::class, 'descargar'])->name('estandares.descargar');
        Route::delete('/estandares/{id}', [EstandarController::class, 'destroy'])->name('estandares.destroy');
    });

    //!=========================================================================================
    Route::get('/trabajos/create', [TrabajoController::class, 'create'])->name('trabajos.create'); // Formulario para crear un nuevo trabajo
    Route::post('/trabajos', [TrabajoController::class, 'store'])->name('trabajos.store'); // Guardar un nuevo trabajo
    // destroy
    Route::delete('/trabajos/{id}', [TrabajoController::class, 'destroy'])->name('trabajos.destroy');
    // edit
    Route::get('/trabajos/{id}/edit', [TrabajoController::class, 'edit'])->name('trabajos.edit');
    Route::put('/trabajos/{id}', [TrabajoController::class, 'update'])->name('trabajos.update');
    Route::delete('/trabajos/imagenes/{id}', [TrabajoController::class, 'destroyImagen'])->name('imagenes.destroy');


});

Route::get('/trabajos', [TrabajoController::class, 'index'])->name('trabajos.index'); // Listar todos los trabajos
Route::get('/trabajos/{id}', [TrabajoController::class, 'show'])->name('trabajos.show'); // Mostrar detalles de un trabajo específico


//!=========================================================================================
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/mi-empresa', [EmpresaController::class, 'showEmpresaCliente'])->name('empresa.cliente');
    // Route::get('/empresas/{empresa}/estandares', [EstandarController::class, 'index'])->name('empresas.estandares');
    Route::get('/mi-empresa/estandares', [EstandarController::class, 'indexCliente'])->name('empresa.estandares.cliente');
    Route::get('/mi-empresa/estandares/{id}/descargar', [EstandarController::class, 'descargarCliente'])->name('estandares.descargar.cliente');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
