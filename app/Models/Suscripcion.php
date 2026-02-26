<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suscripcion extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla
    protected $table = 'suscripciones';

    // Clave primaria
    protected $primaryKey = 'idsuscripciones';

    // Los campos que se pueden llenar masivamente
    protected $fillable = [
        'empresas_idempresas',
        'planes_idplanes',
        'fecha_inicio',
        'ampliacion_cantidad_facturas',
        'fecha_fin',
        'descripcion',
        'estado',
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id',
    ];

    // Cast de fechas
    protected $dates = [
        'fecha_inicio',
        'ampliacion_cantidad_facturas',
        'fecha_fin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Relaciones

    // Empresa a la que pertenece la suscripción
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresas_idempresas', 'idempresas');
    }

    // Plan de la suscripción
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'planes_idplanes', 'idplanes');
    }

    // Usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'usuario_creador_id', 'idusers');
    }

    // Usuario modificador
    public function modificador()
    {
        return $this->belongsTo(User::class, 'usuario_modificador_id', 'idusers');
    }

    // Usuario eliminador
    public function eliminador()
    {
        return $this->belongsTo(User::class, 'usuario_eliminador_id', 'idusers');
    }
}