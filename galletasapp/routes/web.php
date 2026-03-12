<?php

use App\Http\Controllers\GalletaController;
use App\Http\Controllers\VentaController; // Importamos el nuevo controlador
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para gestionar las galletas (CRUD completo)
Route::resource('galletas', GalletaController::class);

// Rutas para las Ventas
// Usamos 'resource' para tener index, create, store, etc.
Route::resource('ventas', VentaController::class);

// Ruta especial para registrar un pago de alguien que debía (Fiado)
// Esta la podemos apuntar a un método específico
Route::post('/ventas/{venta}/pagar-fiado', [VentaController::class, 'pagarFiado'])->name('ventas.pagar');