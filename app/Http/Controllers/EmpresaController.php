<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function listado(){
        return view('empresa.listado');
    }

    public function ajaxListado(Request $request){

        if($request->ajax()){

            $empresas = Empresa::all();

            $valores = [
                'listado' => view('empresa.ajaxListado')
                                ->with(compact('empresas'))
                                ->render()
            ];

            $data = Respuesta::success($valores, "Se procesó con éxito");

        }else{
            $data = Respuesta::error(null, "Error en la función");
        }

        return $data;
    }

    public function guardarEmpresa(Request $request){

        if($request->ajax()){

            $empresa_id = $request->input('idempresas');
            $usuario    = Auth::user();

            if($empresa_id == '0'){

                $empresa = new Empresa();
                $empresa->usuario_creador_id = $usuario->idusers;

            }else{

                $empresa = Empresa::find($empresa_id);

                if(!$empresa){
                    return Respuesta::error(null, "Empresa no encontrada");
                }

                $empresa->usuario_modificador_id = $usuario->idusers;
            }

            $empresa->nombre       = $request->input('nombre');
            $empresa->nit          = $request->input('nit');
            $empresa->razon_social = $request->input('razon_social');
            $empresa->celular      = $request->input('celular');
            $empresa->estado       = $request->input('estado');

            $empresa->save();

            $data = Respuesta::success(null, "Se guardó la empresa con éxito");

        }else{
            $data = Respuesta::error(null, "Error en la función");
        }

        return $data;
    }

    public function eliminarEmpresa(Request $request){

        if($request->ajax()){

            $empresa_id = $request->input('id');
            $usuario    = Auth::user();

            $empresa = Empresa::find($empresa_id);

            if(!$empresa){
                return Respuesta::error(null, "Empresa no encontrada");
            }

            // Guardar usuario eliminador
            $empresa->usuario_eliminador_id = $usuario->idusers;
            $empresa->save();

            // SoftDelete (porque usas softDeletes)
            $empresa->delete();

            $data = Respuesta::success(null, "Se eliminó con éxito");

        }else{
            $data = Respuesta::error(null, "Error en la función");
        }

        return $data;
    }
}