<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\UserController;

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
});

// 🔹 RUTAS DE USUARIOS
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/dispositivos/asignar', [DispositivoController::class, 'asignar'])->name('dispositivos.asignar');

