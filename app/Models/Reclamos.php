<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamos extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en la base de datos
    protected $table = 'reclamaciones';

    // Campos permitidos para inserción masiva
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'apoderado',
        'direccion',
        'urbanizacion',
        'departamento',
        'provincia',
        'distrito',
        'referencia',
        'telefono',
        'celular',
        'correo_electronico',
        'medio_respuesta',
        'tipo_bien',
        'descripcion_bien',  // Agregado
        'monto_reclamado',
        'motivo_contacto',
        'detalle',
        'pedido',
    ];
}
