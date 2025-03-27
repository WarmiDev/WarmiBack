<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'id',
        'producto_nombre',
        'producto_descripcion',
        'producto_precio',
        'producto_stock',
        'marca_id',
        'tipo_producto_id',
    ];

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    public function tipoProducto(){
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id');
    }
}
