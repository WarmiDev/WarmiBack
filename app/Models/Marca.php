<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $fillable = [
        'id',
        'marca_nombre',
        'marca_origen'
    ];

    public function productos(){
        return $this->hasOne(Producto::class);
    }
}
