<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosUser extends Model
{
    use HasFactory;

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class, 'pedido_producto', 'id_producto', 'id_pedido')
                    ->withPivot('cantidad');
    }
}
