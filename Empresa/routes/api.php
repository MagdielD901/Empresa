<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas API de tu aplicación. Estas rutas
| son cargadas por el RouteServiceProvider y estarán bajo el grupo
| "api" middleware.
|
*/

Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
});
