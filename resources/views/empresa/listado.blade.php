@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

<!-- Modal Empresa -->
<div class="modal fade" id="modalEmpresa" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold">FORMULARIO DE EMPRESA</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formularioEmpresa">
                    <input type="hidden" name="idempresas" id="idempresas" value="0">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="required">Nombre</label>
                            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="required">NIT</label>
                            <input type="text" class="form-control form-control-sm" name="nit" id="nit">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="required">Razón Social</label>
                            <input type="text" class="form-control form-control-sm" name="razon_social" id="razon_social">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Celular</label>
                            <input type="text" class="form-control form-control-sm" name="celular" id="celular">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Estado</label>
                            <input type="text" class="form-control form-control-sm" name="estado" id="estado">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm w-100" onclick="guardarEmpresa()">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card shadow-sm">
    <div class="card-header bg-light-primary d-flex justify-content-between">
        <h3 class="card-title">Listado de Empresas</h3>
        <button class="btn btn-primary btn-sm" onclick="modalNuevaEmpresa()">
            <i class="fa fa-plus"></i> Nueva Empresa
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
    ajaxListadoEmpresas();
});

function ajaxListadoEmpresas(){
    $.post("{{ route('empresa.ajaxListado') }}", {}, function(resultado){
        if(resultado.estado){
            $('#table_listado').html(resultado.data.listado);
        }
    });
}

function modalNuevaEmpresa(){
    $('#formularioEmpresa')[0].reset();
    $('#idempresas').val(0);
    limpiarErrores();
    $('#modalEmpresa').modal('show');
}

function guardarEmpresa(){

    let datos = $('#formularioEmpresa').serialize();

    $.post("{{ route('empresa.guardarEmpresa') }}", datos)
    .done(function(resultado){

        if(resultado.estado){
            Swal.fire({
                title: "Registro exitoso",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });

            $('#modalEmpresa').modal('hide');
            ajaxListadoEmpresas();
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

function editarEmpresa(empresa){

    limpiarErrores();

    $('#idempresas').val(empresa.idempresas);
    $('#nombre').val(empresa.nombre);
    $('#nit').val(empresa.nit);
    $('#razon_social').val(empresa.razon_social);
    $('#celular').val(empresa.celular);
    $('#estado').val(empresa.estado);

    $('#modalEmpresa').modal('show');
}

function eliminarEmpresa(id, nombre){

    Swal.fire({
        title: "¿Eliminar " + nombre + "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar"
    }).then((result)=>{

        if(result.isConfirmed){

            $.post("{{ route('empresa.eliminarEmpresa') }}", { id:id }, function(resultado){

                if(resultado.estado){
                    ajaxListadoEmpresas();
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