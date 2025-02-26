<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envios extends Model
{
    protected $fillable = [
        'id_pedido',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'telefono',
        'instrucciones',
    ];
}
