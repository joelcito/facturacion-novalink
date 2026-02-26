@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

<!-- Modal Sucursal -->
<div class="modal fade" id="modalSucursal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold">FORMULARIO DE SUCURSAL</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formularioSucursal">
                    <input type="hidden" name="idsucursales" id="idsucursales" value="0">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="required">Empresa</label>
                            <select name="empresas_idempresas" id="empresas_idempresas" class="form-control form-control-sm">
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->idempresas }}">
                                        {{ $empresa->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="required">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Código Sucursal</label>
                            <input type="text" name="codigo_sucursal" id="codigo_sucursal" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Dirección</label>
                            <textarea name="direccion" id="direccion" class="form-control form-control-sm"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Municipio</label>
                            <input type="text" name="municipio" id="municipio" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control form-control-sm">
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm w-100" onclick="guardarSucursal()">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-light-info d-flex justify-content-between">
        <h3 class="card-title">Listado de Sucursales</h3>
        <button class="btn btn-primary btn-sm" onclick="modalNuevaSucursal()">
            <i class="fa fa-plus"></i> Nueva Sucursal
        </button>
    </div>

    <div class="card-body" id="table_listado">
        <!-- AJAX -->
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    ajaxListado();
});

function ajaxListado(){
    $.post("{{ route('sucursal.ajaxListado') }}", {}, function(resultado){
        if(resultado.estado){
            $('#table_listado').html(resultado.data.listado);
        }
    });
}

function modalNuevaSucursal(){
    $('#formularioSucursal')[0].reset();
    $('#idsucursales').val(0);
    limpiarErrores();
    $('#modalSucursal').modal('show');
}

function guardarSucursal(){

    let datos = $('#formularioSucursal').serialize();

    $.post("{{ route('sucursal.guardarSucursal') }}", datos)
    .done(function(resultado){

        if(resultado.estado){
            Swal.fire({
                title: "Registro exitoso",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });

            $('#modalSucursal').modal('hide');
            ajaxListado();
        }

    }).fail(function(xhr){

        limpiarErrores();

        if(xhr.status === 422){
            let errores = xhr.responseJSON.errors;

            for(let campo in errores){
                let input = $(`[name="${campo}"]`);
                input.addClass("is-invalid");
                input.after(`<div class="invalid-feedback">${errores[campo][0]}</div>`);
            }
        }
    });
}

function editarSucursal(sucursal){

    limpiarErrores();

    $('#idsucursales').val(sucursal.idsucursales);
    $('#empresas_idempresas').val(sucursal.empresas_idempresas);
    $('#nombre').val(sucursal.nombre);
    $('#codigo_sucursal').val(sucursal.codigo_sucursal);
    $('#celular').val(sucursal.celular);
    $('#direccion').val(sucursal.direccion);
    $('#municipio').val(sucursal.municipio);
    $('#estado').val(sucursal.estado);

    $('#modalSucursal').modal('show');
}

function eliminarSucursal(id, nombre){

    Swal.fire({
        title: "¿Eliminar " + nombre + "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar"
    }).then((result)=>{

        if(result.isConfirmed){

            $.post("{{ route('sucursal.eliminarSucursal') }}", { id:id }, function(resultado){

                if(resultado.estado){
                    ajaxListado();
                    Swal.fire("Eliminado!", "", "success");
                }

            });
        }
    });
}

function limpiarErrores(){
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
}

</script>

@endsection