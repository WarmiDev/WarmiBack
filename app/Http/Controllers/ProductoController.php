<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function crearProducto(Request $request)
    {
        try {
            $request->validate([
                'producto_nombre' => 'required|string|max:100',
                'producto_descripcion' => 'required|string|max:200',
                'producto_precio' => 'required|numeric',
                'producto_stock' => 'required|integer',
                'marca_id' => 'required|exists:marcas,id',
                'tipo_producto_id' => 'required|exists:tipo_productos,id',
            ]);

            $producto = new Producto();
            $producto->producto_nombre = $request->input('producto_nombre');
            $producto->producto_descripcion = $request->input('producto_descripcion');
            $producto->producto_precio = $request->input('producto_precio');
            $producto->producto_stock = $request->input('producto_stock');
            $producto->marca_id = $request->input('marca_id');
            $producto->tipo_producto_id = $request->input('tipo_producto_id');
            $producto->save();

            return response()->json([
                'status' => true,
                'message' => 'Producto creado correctamente',
                'producto' => $producto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function listarProductos()
    {
        try {
            $productos = Producto::with(
                'marca',
                'tipoProducto'
            )->get();

            $data = [];
            foreach ($productos as $producto) {
                $data[] = [
                    'id' => $producto->id,
                    'producto_nombre' => $producto->producto_nombre,
                    'producto_descripcion' => $producto->producto_descripcion,
                    'producto_precio' => $producto->producto_precio,
                    'producto_stock' => $producto->producto_stock,
                    'marca_nombre' => $producto->marca->marca_nombre,
                    'marca_origen' => $producto->marca->marca_origen,
                    'tipo_producto_nombre' => $producto->tipoProducto->tipo_producto_nombre,
                    'tipo_producto_descripcion' => $producto->tipoProducto->tipo_producto_descripcion
                ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Productos obtenidos correctamente',
                'productos' => $data ?? $productos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener los productos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function borrarProducto($producto_id)
    {
        try {
            $producto = Producto::find($producto_id);
            if (!$producto) {
                return response()->json([
                    'status' => false,
                    'message' => 'Producto no encontrado',
                ], 404);
            }
            
            $producto->delete();

            return response()->json([
                'status' => true,
                'message' => 'Producto borrado correctamente',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al borrar el producto',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
