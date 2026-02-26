<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Empresa;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SucursalController extends Controller
{
    // Mostrar vista de listado de sucursales
    public function listado()
    {
        // Traemos todas las empresas para el select en el modal
        $empresas = Empresa::all();

        return view('sucursal.listado', compact('empresas'));
    }

    // Listado AJAX
    public function ajaxListado(Request $request)
    {
        if($request->ajax()){

            $sucursales = Sucursal::with('empresa')->get();

            $valores = [
                'listado' => view('sucursal.ajaxListado')
                                ->with(compact('sucursales'))
                                ->render()
            ];

            $data = Respuesta::success($valores, "Se procesó con éxito");

        } else {
            $data = Respuesta::error(null, "Error en la función");
        }

        return $data;
    }

    // Guardar nueva sucursal o actualizar existente
    public function guardarSucursal(Request $request)
    {
        if($request->ajax()){

            $sucursal_id = $request->input('idsucursales');
            $usuario     = Auth::user();

            if($sucursal_id == '0') {
                // Crear nueva
                $sucursal = new Sucursal();
                $sucursal->usuario_creador_id = $usuario->idusers;
            } else {
                // Editar existente
                $sucursal = Sucursal::find($sucursal_id);

                if(!$sucursal){
                    return Respuesta::error(null, "Sucursal no encontrada");
                }

                $sucursal->usuario_modificador_id = $usuario->idusers;
            }

            // Asignar valores
            $sucursal->empresas_idempresas = $request->input('empresas_idempresas');
            $sucursal->nombre              = $request->input('nombre');
            $sucursal->codigo_sucursal     = $request->input('codigo_sucursal');
            $sucursal->direccion           = $request->input('direccion');
            $sucursal->celular             = $request->input('celular');
            $sucursal->municipio           = $request->input('municipio');
            $sucursal->estado              = $request->input('estado');

            $sucursal->save();

            $data = Respuesta::success(null, "Se guardó la sucursal con éxito");

        } else {
            $data = Respuesta::error(null, "Error en la función");
        }

        return $data;
    }

    // Eliminar sucursal
    public function eliminarSucursal(Request $request)
    {
        if($request->ajax()){

            $sucursal_id = $request->input('id');
            $usuario     = Auth::user();

            $sucursal = Sucursal::find($sucursal_id);

            if(!$sucursal){
                return Respuesta::error(null, "Sucursal no encontrada");
            }

            // Guardar usuario eliminador
            $sucursal->usuario_eliminador_id = $usuario->idusers;
            $sucursal->save();

            // Soft delete
            $sucursal->delete();

            $data = Respuesta::success(null, "Se eliminó la sucursal con éxito");

        } else {
            $data = Respuesta::error(null, "Error en la función");
        }

        return $data;
    }
}