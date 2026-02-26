<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Vista principal de planes
     */
    public function listado()
    {
        return view('plan.listado');
    }

    /**
     * Listado AJAX
     */
    public function ajaxListado(Request $request)
    {
        if ($request->ajax()) {
            $planes = Plan::all();

            $valores = [
                'listado' => view('plan.ajaxListado', compact('planes'))->render()
            ];

            return Respuesta::success($valores, "Listado cargado correctamente");
        }

        return Respuesta::error(null, "Error en la función");
    }

    /**
     * Crear o actualizar un plan
     */
    public function guardarPlan(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('idplanes', 0);
            $usuario = Auth::user();

            if ($id == 0) {
                $plan = new Plan();
                $plan->usuario_creador_id = $usuario->id;
            } else {
                $plan = Plan::find($id);
                $plan->usuario_modificador_id = $usuario->id;
            }

            $plan->nombre               = $request->input('nombre');
            $plan->tipo_plan            = $request->input('tipo_plan');
            $plan->precio               = $request->input('precio');
            $plan->cantidad_facturas    = $request->input('cantidad_facturas');
            $plan->cantidad_sucursal    = $request->input('cantidad_sucursal');
            $plan->cantidad_punto_venta = $request->input('cantidad_punto_venta');
            $plan->cantidad_usuario     = $request->input('cantidad_usuario');
            $plan->cantidad_producto    = $request->input('cantidad_producto');
            $plan->cantidad_cliente     = $request->input('cantidad_cliente');
            $plan->estado               = $request->input('estado');

            $plan->save();

            return Respuesta::success(null, $id == 0 ? "Plan creado exitosamente" : "Plan actualizado exitosamente");
        }

        return Respuesta::error(null, "Error en la función");
    }

    /**
     * Eliminar un plan
     */
    public function eliminarPlan(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $usuario = Auth::user();

            $plan = Plan::find($id);
            if ($plan) {
                $plan->usuario_eliminador_id = $usuario->id;
                $plan->save();

                $plan->delete();

                return Respuesta::success(null, "Plan eliminado correctamente");
            }

            return Respuesta::error(null, "Plan no encontrado");
        }

        return Respuesta::error(null, "Error en la función");
    }
}