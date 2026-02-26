<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Models\Empresa;
use App\Models\Plan;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscripcionController extends Controller
{
    /**
     * Vista principal de suscripciones
     */
    public function listado()
    {
        $empresas = Empresa::all();
        $planes   = Plan::all();

        return view('suscripcion.listado', compact('empresas', 'planes'));
    }

    /**
     * Listado AJAX
     */
    public function ajaxListado(Request $request)
    {
        if ($request->ajax()) {
            $suscripciones = Suscripcion::with(['empresa', 'plan'])->get();

            $valores = [
                'listado' => view('suscripcion.ajaxListado', compact('suscripciones'))->render()
            ];

            return Respuesta::success($valores, "Listado cargado correctamente");
        }

        return Respuesta::error(null, "Error en la función");
    }

    /**
     * Crear o actualizar suscripción
     */
    public function guardarSuscripcion(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('idsuscripciones', 0);
            $usuario = Auth::user();

            if ($id == 0) {
                $suscripcion = new Suscripcion();
                $suscripcion->usuario_creador_id = $usuario->id;
            } else {
                $suscripcion = Suscripcion::find($id);
                $suscripcion->usuario_modificador_id = $usuario->id;
            }

            $suscripcion->empresas_idempresas           = $request->input('empresas_idempresas');
            $suscripcion->planes_idplanes               = $request->input('planes_idplanes');
            $suscripcion->fecha_inicio                  = $request->input('fecha_inicio');
            $suscripcion->ampliacion_cantidad_facturas  = $request->input('ampliacion_cantidad_facturas');
            $suscripcion->fecha_fin                     = $request->input('fecha_fin');
            $suscripcion->descripcion                   = $request->input('descripcion');
            $suscripcion->estado                        = $request->input('estado');

            $suscripcion->save();

            return Respuesta::success(null, $id == 0 ? "Suscripción creada exitosamente" : "Suscripción actualizada exitosamente");
        }

        return Respuesta::error(null, "Error en la función");
    }

    /**
     * Eliminar suscripción
     */
    public function eliminarSuscripcion(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('idsuscripciones');
            $usuario = Auth::user();

            $suscripcion = Suscripcion::find($id);
            if ($suscripcion) {
                $suscripcion->usuario_eliminador_id = $usuario->id;
                $suscripcion->save();

                $suscripcion->delete();

                return Respuesta::success(null, "Suscripción eliminada correctamente");
            }

            return Respuesta::error(null, "Suscripción no encontrada");
        }

        return Respuesta::error(null, "Error en la función");
    }
}
