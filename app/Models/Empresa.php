<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'empresas';
    protected $primaryKey = 'idempresas';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'nit',
        'razon_social',
        'celular',
        'codigo_ambiente',
        'codigo_modalidad',
        'codigo_sistema',
        'codigo_documento_sector',
        'api_key',
        'cafc',
        'archivop12',
        'contrasenia',
        'estado',
        'usuario_creador_id',
        'usuario_modificador_id',
        'usuario_eliminador_id'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    // Usuario que creó
    public function creador()
    {
        return $this->belongsTo(User::class, 'usuario_creador_id', 'idusers');
    }

    // Usuario que modificó
    public function modificador()
    {
        return $this->belongsTo(User::class, 'usuario_modificador_id', 'idusers');
    }

    // Usuario que eliminó
    public function eliminador()
    {
        return $this->belongsTo(User::class, 'usuario_eliminador_id', 'idusers');
    }
}
