<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function crearMarca(Request $request){
        //Instanciamos la clase
        $marca = new Marca();

        //Asignamos los valores
        $request->validate([
            'marca_nombre' => 'required|string|max:100',
            'marca_origen' => 'required|string|max:100'
        ]);
        
        $marca->marca_nombre = $request->input('marca_nombre');
        $marca->marca_origen = $request->input('marca_origen');

        //Guardamos
        $marca->save();

        //Respuesta
        return response()->json([
            'status' => true,
            'marca' => $marca
        ],201);
    }

    public function listarMarcas(){

        // llamar a todas las marcas
        $marcas = Marca::all();

        // Respuesta
        return response()->json([
            'status' => true,
            'marcas' => $marcas
        ],200);
    }
}
