<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $table = "inventarios";
    protected $fillable = [
        'fechaEntrada', 'cantidadProducto', 'idProducto'
    ];
    protected $primarykey = 'id';
}
