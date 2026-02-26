<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    // Nombre de la tabla
    protected $table = 'planes';

    // Nombre de la clave primaria
    protected $primaryKey = 'idplanes';

    // Tipo de clave primaria
    protected $keyType = 'int';

    // No usa autoincrement? Si usas id bigIncrements
    public $incrementing = true;

    // Laravel manejará automáticamente created_at y updated_at
    public $timestamps = true;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'precio',
        'nombre',
        'tipo_plan',
        'cantidad_facturas',
        'cantidad_sucursal',
        'cantidad_punto_venta',
        'cantidad_usuario',
        'cantidad_producto',
        'cantidad_cliente',
        'estado',
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id'
    ];

    // Fecha de soft delete
    protected $dates = ['deleted_at'];

    // Relación con el usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'usuario_creador_id', 'idusers');
    }

    // Relación con el usuario que modificó
    public function modificador()
    {
        return $this->belongsTo(User::class, 'usuario_modificador_id', 'idusers');
    }

    // Relación con el usuario que eliminó
    public function eliminador()
    {
        return $this->belongsTo(User::class, 'usuario_eliminador_id', 'idusers');
    }
}
