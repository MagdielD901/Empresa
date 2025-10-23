<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartaPoderController;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




// 🔹 RUTA PRINCIPAL
Route::get('/', function () {
    return view('welcome');
});

// 🔹 RUTAS DE DISPOSITIVOS
Route::get('/devices', [DispositivoController::class, 'index'])->name('dispositivos.index');
Route::post('/devices', [DispositivoController::class, 'store'])->name('dispositivos.store');
Route::get('/devices/{id}/edit', [DispositivoController::class, 'edit'])->name('dispositivos.edit');
Route::put('/devices/{id}', [DispositivoController::class, 'update'])->name('dispositivos.update');
Route::delete('/devices/{id}', [DispositivoController::class, 'destroy'])->name('dispositivos.destroy');

// 🔹 RUTAS ADMIN
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('admin.profile');
})->name('profile');


// 🔹 RUTAS DE USUARIOS
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/dispositivos/asignar', [DispositivoController::class, 'asignar'])->name('dispositivos.asignar');
Route::put('/devices/{id}/cambiar-estado', [App\Http\Controllers\DispositivoController::class, 'cambiarEstado'])
    ->name('dispositivos.cambiarEstado');


//Ruta de la carta poder
Route::get('/carta-poder', [CartaPoderController::class, 'generarCarta']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'dashboard'], function(){
    Route::get("/", function() {
    return view('admin.dashboard');
    });
    Route::get("/users",[UsersController::class,'getUsers']);
    Route::post("/users",[UsersController::class,'createUsers']);
});


Route::get('/users/{id}/carta-poder', [CartaPoderController::class, 'generar'])->name('users.cartaPoder');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');