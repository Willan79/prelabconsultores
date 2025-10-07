<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar rutas API para tu aplicación. Estas rutas son cargadas por
| RouteServiceProvider dentro de un grupo al que se le asigna el grupo de middleware "api".
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
