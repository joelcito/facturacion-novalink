@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

<!-- Modal Suscripcion -->
<div class="modal fade" id="modalSuscripcion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold">FORMULARIO DE SUSCRIPCIÓN</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formularioSuscripcion">
                    <input type="hidden" name="idsuscripciones" id="idsuscripciones" value="0">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="required">Empresa</label>
                            <select name="empresas_idempresas" id="empresas_idempresas" class="form-control form-control-sm">
                                <option value="">Seleccionar Empresa</option>
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->idempresas }}">{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="required">Plan</label>
                            <select name="planes_idplanes" id="planes_idplanes" class="form-control form-control-sm">
                                <option value="">Seleccionar Plan</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->idplanes }}">{{ $plan->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="required">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Ampliación Facturas</label>
                            <input type="date" name="ampliacion_cantidad_facturas" id="ampliacion_cantidad_facturas" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control form-control-sm"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control form-control-sm">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm w-100" onclick="guardarSuscripcion()">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-light-info d-flex justify-content-between">
        <h3 class="card-title">Listado de Suscripciones</h3>
        <button class="btn btn-primary btn-sm" onclick="modalNuevaSuscripcion()">
            <i class="fa fa-plus"></i> Nueva Suscripción
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
    $.post("{{ route('suscripcion.ajaxListado') }}", {}, function(resultado){
        if(resultado.estado){
            $('#table_listado').html(resultado.data.listado);
        }
    });
}

function modalNuevaSuscripcion(){
    $('#formularioSuscripcion')[0].reset();
    $('#idsuscripciones').val(0);
    limpiarErrores();
    $('#modalSuscripcion').modal('show');
}

function limpiarErrores(){
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
}
</script>
@endsection