<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//RUTAS DE MARCAS
Route::post('/crear-marca', [MarcaController::class, 'crearMarca']);
Route::get('/listar-marcas', [MarcaController::class, 'listarMarcas']);

//RUTAS DE TIPOS DE PRODUCTOS
Route::post('/crear-tipo-producto', [TipoProductoController::class, 'crearTipoProducto']);
Route::get('/listar-tipos-productos', [TipoProductoController::class, 'listarTiposProductos']);

//RUTAS DE PRODUCTOS
Route::post('/crear-producto', [ProductoController::class, 'crearProducto']);
Route::get('/listar-productos', [ProductoController::class, 'listarProductos']);
Route::delete('/borrar-producto/{producto_id}', [ProductoController::class, 'borrarProducto']);

//SIMULAR VENTA
Route::put('/simular-venta/{producto_id}', [VentaController::class, 'simularVenta']);