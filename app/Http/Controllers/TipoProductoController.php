<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{

    public function crearTipoProducto(Request $request)
    {
        try {
            $request->validate([
                'tipo_producto_nombre' => 'required|string|max:100',
                'tipo_producto_descripcion' => 'required|string|max:200',
            ]);

            $tipoProducto = new TipoProducto();
            $tipoProducto->tipo_producto_nombre = $request->input('tipo_producto_nombre');
            $tipoProducto->tipo_producto_descripcion = $request->input('tipo_producto_descripcion');
            $tipoProducto->save();
            return response()->json([
                'status' => true,
                'message' => 'Tipo de producto creado correctamente',
                'tipo_producto' => $tipoProducto,
            ], 201);
       } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el tipo de producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function listarTiposProductos(){
        $tipoProductos = TipoProducto::all();
        return response()->json([
            'status' => true,
            'message' => 'Tipos de productos obtenidos correctamente',
            'tipos_productos' => $tipoProductos
        ]);
    }
}
