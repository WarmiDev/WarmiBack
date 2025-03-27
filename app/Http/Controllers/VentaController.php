<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function simularVenta(Request $request, $producto_id)
    {
        try {
            $producto = Producto::where('id', $producto_id)
                ->where('producto_stock', '>', 0)
                ->first();

            if (!$producto) {
                return response()->json([
                    'status' => false,
                    'message' => 'Producto no encontrado o sin stock disponible',
                ], 404);
            }

            $request->validate([
                'nombre' => 'required|string|max:100',
                'apellido' => 'required|string|max:100',
                'dni' => 'required|string|size:8',
                'cantidad' => 'required|integer',
                'producto_id' => 'required|exists:productos,id',
            ]);

            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $dni = $request->input('dni');
            $cantidad = $request->input('cantidad');

            if($producto->producto_stock < $cantidad){
                return response()->json([
                    'status' => false,
                    'message' => 'La cantidad solicitada supera el stock disponible',
                    'cantidad_solicitada' => $cantidad,
                    'stock_disponible' => $producto->producto_stock,
                ], 400);
            }

            $precio_total = $producto->producto_precio * $cantidad;

            $datos_producto = [
                'producto_nombre' => $producto->producto_nombre,
                'producto_descripcion' => $producto->producto_descripcion,
                'producto_marca' => $producto->marca->marca_nombre,
                'producto_origen' => $producto->marca->marca_origen,
                'producto_tipo' => $producto->tipoProducto->tipo_producto_nombre
            ];

            $producto->producto_stock = $producto->producto_stock - $cantidad;
            $producto->save();

            return response()->json([
                'status' => true,
                'message' => 'Venta simulada exitosamente',
                'data' => [
                    'datos_producto' => $datos_producto,
                    'datos_cliente' => [
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'dni' => $dni,
                    ],
                    'datos_venta' => [
                        'cantidad' => $cantidad,
                        'precio_unitario' => 'S/. ' . $producto->producto_precio,
                        'total' => 'S/. ' . $precio_total,
                    ],
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al simular la venta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
