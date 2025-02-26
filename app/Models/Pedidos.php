<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\productos;

class Pedidos extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_estado_pedido',
        'fecha_pedido',
        'total',
    ];

    public function productos()
    {
        return $this->belongsToMany(productos::class, 'pedido_producto', 'id_pedido', 'id_producto')
                    ->withPivot('cantidad');
    }
}
