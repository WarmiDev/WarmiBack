<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipo_productos';
    protected $fillable = [
        'id',
        'tipo_producto_nombre',
        'tipo_producto_descripcion',
    ];
    public function productos(){
        return $this->hasOne(Producto::class);
    }
}
