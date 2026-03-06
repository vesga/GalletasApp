<?php
use App\Http\Controllers\GalletaController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('galletas', GalletaController::class);