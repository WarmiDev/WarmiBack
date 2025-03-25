<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'producto_id',
        'producto_nombre',
        'producto_descripcion',
        'producto_precio',
        'producto_stock',
        'marca_id',
        'tipo_producto_id',
    ];
}
