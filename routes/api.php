<?php

use App\Http\Controllers\MarcaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/crear-marca', [MarcaController::class, 'crearMarca']);
Route::get('/listar-marcas', [MarcaController::class, 'listarMarcas']);