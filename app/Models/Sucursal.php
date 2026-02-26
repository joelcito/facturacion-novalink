<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use SoftDeletes;

    protected $table = 'sucursales';

    protected $primaryKey = 'idsucursales';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'empresas_idempresas',
        'nombre',
        'codigo_sucursal',
        'direccion',
        'celular',
        'municipio',
        'estado',
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    // Relación con Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 
            'empresas_idempresas', 
            'idempresas');
    }

    // Usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 
            'usuario_creador_id', 
            'idusers');
    }

    // Usuario modificador
    public function modificador()
    {
        return $this->belongsTo(User::class, 
            'usuario_modificador_id', 
            'idusers');
    }

    // Usuario eliminador
    public function eliminador()
    {
        return $this->belongsTo(User::class, 
            'usuario_eliminador_id', 
            'idusers');
    }

    /*
    |--------------------------------------------------------------------------
    | EVENTOS AUTOMÁTICOS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::creating(function ($sucursal) {
            if (auth()->check()) {
                $sucursal->usuario_creador_id = auth()->id();
            }
        });

        static::updating(function ($sucursal) {
            if (auth()->check()) {
                $sucursal->usuario_modificador_id = auth()->id();
            }
        });
    }
}