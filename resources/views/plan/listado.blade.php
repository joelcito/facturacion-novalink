@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

<!-- Modal Plan -->
<div class="modal fade" id="modalPlan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold">FORMULARIO DE PLAN</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formularioPlan">
                    <input type="hidden" name="idplanes" id="idplanes" value="0">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="required">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="required">Tipo de Plan</label>
                            <input type="text" name="tipo_plan" id="tipo_plan" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="required">Precio</label>
                            <input type="number" step="0.01" name="precio" id="precio" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Cantidad Facturas</label>
                            <input type="number" step="0.01" name="cantidad_facturas" id="cantidad_facturas" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Cantidad Sucursales</label>
                            <input type="number" step="0.01" name="cantidad_sucursal" id="cantidad_sucursal" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Cantidad Puntos de Venta</label>
                            <input type="number" step="0.01" name="cantidad_punto_venta" id="cantidad_punto_venta" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Cantidad Usuarios</label>
                            <input type="number" step="0.01" name="cantidad_usuario" id="cantidad_usuario" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Cantidad Productos</label>
                            <input type="number" step="0.01" name="cantidad_producto" id="cantidad_producto" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Cantidad Clientes</label>
                            <input type="number" step="0.01" name="cantidad_cliente" id="cantidad_cliente" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control form-control-sm">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm w-100" onclick="guardarPlan()">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-light-info d-flex justify-content-between">
        <h3 class="card-title">Listado de Planes</h3>
        <button class="btn btn-primary btn-sm" onclick="modalNuevoPlan()">
            <i class="fa fa-plus"></i> Nuevo Plan
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
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

$(document).ready(function() {
    ajaxListado();
});

function ajaxListado(){
    $.post("{{ route('plan.ajaxListado') }}", {}, function(resultado){
        if(resultado.estado){
            $('#table_listado').html(resultado.data.listado);
        }
    });
}

function modalNuevoPlan(){
    $('#formularioPlan')[0].reset();
    $('#idplanes').val(0);
    limpiarErrores();
    $('#modalPlan').modal('show');
}

function guardarPlan(){
    let datos = $('#formularioPlan').serialize();

    $.post("{{ route('plan.guardarPlan') }}", datos)
    .done(function(resultado){
        if(resultado.estado){
            Swal.fire({ title: "Registro exitoso", icon: "success", timer: 2000, showConfirmButton: false });
            $('#modalPlan').modal('hide');
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

function editarPlan(plan){
    limpiarErrores();
    $('#idplanes').val(plan.idplanes);
    $('#nombre').val(plan.nombre);
    $('#tipo_plan').val(plan.tipo_plan);
    $('#precio').val(plan.precio);
    $('#cantidad_facturas').val(plan.cantidad_facturas);
    $('#cantidad_sucursal').val(plan.cantidad_sucursal);
    $('#cantidad_punto_venta').val(plan.cantidad_punto_venta);
    $('#cantidad_usuario').val(plan.cantidad_usuario);
    $('#cantidad_producto').val(plan.cantidad_producto);
    $('#cantidad_cliente').val(plan.cantidad_cliente);
    $('#estado').val(plan.estado);

    $('#modalPlan').modal('show');
}

function eliminarPlan(id, nombre){
    Swal.fire({
        title: "¿Eliminar " + nombre + "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar"
    }).then((result)=>{
        if(result.isConfirmed){
            $.post("{{ route('plan.eliminarPlan') }}", { id:id }, function(resultado){
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