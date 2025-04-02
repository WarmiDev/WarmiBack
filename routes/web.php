<?php

use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;

// ruta fallback captura cualquier URL que no coincida con otras rutas definidas
Route::fallback(function () {
    return view('welcome');
});

Route::post('/crear-marca', [MarcaController::class, 'crearMarca']);
