@extends('layouts/layoutMaster')

@section('title', 'Previsualizar - Orden de Trabajo')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-ot.css')}}" />
@endsection



@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/autosize/autosize.js')}}"></script>
@endsection


@section('page-script')
<script src="{{asset('assets/js/app-ot-preview.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-add-payment.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-send-invoice.js')}}"></script>
@endsection

@section('content')

<div class="row ot-preview">
  <!-- OT PREVIEW-->
  <div id="printContent">
    <div class="col-lg-10 col-12 mb-lg-0 mb-4">
      <div class="card ot-preview-card">
        <div class="card-body">
          <div class="row p-sm-3 p-0">
            <div class="col-md-12 mb-md-0 mb-4">
              <div class="header-image">
                <img src="{{asset('assets/img/branding/DECIMA_ADM.png')}}" alt="Encabezado" class="img-fluid"/>
            </div>
              <p class="mb-0 text-center">DGAF / DA / UMCSTC FORM Nº 001</p>
            </div>
          </div>

          <div class="bg-secondary d-flex align-items-center justify-content-center py-2">
            <h4 class="d-inline-block mb-0 text-dark"><strong> ORDEN DE TRABAJO N°: </strong></h4>
            <input type="text" class="d-inline-block mx-2 bg-secondary text-center text-xl-bold" name="orden_trabajo_num" id="orden_trabajo_num" value="" style="width: 10%; border: none; outline: none;">
            <h4 class="d-inline-block mb-0 text-dark"> (VEHICULOS)</h4>
          </div>

          <div class="row">
            <div class="col-md text-end">
              <div class="form-check form-check-inline form-check-lg form-check-secondary  mt-3 mb-3">
                <label class="form-check-label" for="ot_Ordinarios">ORDINARIO</label>
                <input class="form-check-input" type="checkbox" name="ot_type" id="ot_Ordinario" value="ORDINARIO"/>
              </div>
              <div class="form-check form-check-secondary form-check-inline mt-3 mb-3">
                <label class="form-check-label" for="ot_Extraordinarios">EXTRAORDINARIO</label>
                <input class="form-check-input" type="checkbox" name="ot_type" id="ot_Extraordinario" value="EXTRAORDINARIO" />
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-6  mt-3 mb-2">
                <div class="mb-3 row align-items-center">
                  <input type="hidden" name="idMovil" id="idMovil" value="">
                  <label for="vehiculo_tipo" class="col-md-4 col-form-label">VEHICULO TIPO:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="vehiculo_tipo" id="vehiculo_tipo" />
                  </div>
                </div>
              </div>
              <div class="col-md-6  mt-3 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_chapa" class="col-md-4 col-form-label text-end">CHAPA N°:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="vehiculo_chapa" id="vehiculo_chapa" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_ordenum" class="col-md-6 col-form-label">N° DE ORDEN ASIGNADO:</label>
                  <div class="col-md-6">
                    <input class="form-control texto-sm-med" type="text" name="vehiculo_ordenum" id="vehiculo_ordenum" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_marca" class="col-md-4 col-form-label text-end">MARCA:</label>
                  <div class="col-md-8">
                    <input class="form-control texto-sm-med" type="text" name="vehiculo_marca" id="vehiculo_marca" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_modelo" class="col-md-4 col-form-label text-end">MODELO:</label>
                  <div class="col-md-8">
                    <input class="form-control texto-sm-med" type="text" name="vehiculo_modelo" id="vehiculo_modelo" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_rasp" class="col-md-6 col-form-label">R.A.S.P. N°:</label>
                  <div class="col-md-6">
                    <input class="form-control texto-sm-med" type="text" name="vehiculo_rasp" id="vehiculo_rasp" />
                  </div>
                </div>
              </div>
              <div class="col-md-8 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_area" class="col-md-3 col-form-label text-end">AREA ASIGNADA:</label>
                  <div class="col-md-9">
                    <input class="form-control" type="text" name="ot_area" id="ot_area" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-8 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_conductores" class="col-md-3 col-form-label">CONDUCTOR/ES ASIGNADO/S:</label>
                  <div class="col-md-9">
                    <textarea id="ot_conductores" rows="3" class="form-control texto-sm-largos" ></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_conductoresCI" class="col-md-3 col-form-label text-end ">C.I. N°:</label>
                  <div class="col-md-9 ">
                    <textarea id="ot_conductoresCI" rows="3" class="form-control texto-sm-largos" ></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_ordenum" class="col-md-12 col-form-label fw-bold">DIAS ESTIMADOS DE MISION:</label>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_fechaDesde" class="col-md-4 col-form-label text-end">DESDE:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="ot_fechaDesde" id="ot_fechaDesde" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_fechaHasta" class="col-md-4 col-form-label text-end">HASTA:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="ot_fechaHasta" id="ot_fechaHasta" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-4 mb-2">
                <div class="mb-3 row">
                  <label for="vehiculo_ordenum" class="col-md-12 col-form-label fw-bold">HORAS ESTIMADAS DE MISION:</label>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_horaDesde" class="col-md-4 col-form-label text-end">DESDE:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="ot_horaDesde" id="ot_horaDesde" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="ot_horaHasta" class="col-md-4 col-form-label text-end">HASTA:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="ot_horaHasta" id="ot_horaHasta" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_kmInicial" class="col-md-6 col-form-label">KM. DE SALIDA:</label>
                  <div class="col-md-6">
                    <input class="form-control" type="text" name="vehiculo_kmInicial" id="vehiculo_kmInicial" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_kmFinal" class="col-md-6 col-form-label text-end">KM. DE REGRESO</label>
                  <div class="col-md-6">
                    <input class="form-control" type="text" name="vehiculo_kmFinal" id="vehiculo_kmFinal" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_kmTotal" class="col-md-6 col-form-label text-end">KM. TOTAL RECORRIDO:</label>
                  <div class="col-md-6">
                    <input class="form-control" type="text" name="vehiculo_kmTotal" id="vehiculo_kmTotal" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-center">
              <div class="col-md-6 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_kmEstimado" class="col-md-6 col-form-label">KM. ESTIMADO A RECORRER:</label>
                  <div class="col-md-6">
                    <input class="form-control" type="text" name="vehiculo_kmEstimado" id="vehiculo_kmEstimado" />
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="vehiculo_consumo" class="col-md-6 col-form-label text-end">CONSUMO ESTIMADO X 100 KM./LITROS:</label>
                  <div class="col-md-6">
                    <input class="form-control" type="text" name="vehiculo_consumo" id="vehiculo_consumo" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="mb-3 row">
                  <label for="ot_trabajos" class="col-md-3 col-form-label">TRABAJOS A REALIZAR:</label>
                  <div class="col-md-9">
                    <textarea class="form-control texto-sm-largos" rows="3" type="text" name="ot_trabajos" id="ot_trabajos"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-1" />

            <div class="row py-sm-3">
              <div class="col-md-4 mb-md-0 mb-3">
                <div class="d-flex align-items-center mb-1">
                  <textarea class="form-control text-center align-text-bottom"  rows="4" id="ot_fecha" placeholder=""></textarea>
                </div>
                <label for="ot_fecha" class="form-label fw-bold text-center" style="display: block; width: 100%; text-align: center;">FECHA</label>
              </div>
              <div class="col-md-4 mb-md-0 mb-3">
                <div class="d-flex align-items-center mb-1">
                  <textarea class="form-control" rows="4" id="ot_firmasConductores" placeholder=""></textarea>
                </div>
                <label for="ot_firmasConductores"  class="form-label fw-bold text-center">FIRMA, ACLARACION Y SELLO DEL/LOS CONDUCTOR/ES</label>
              </div>
              <div class="col-md-4 mb-md-0 mb-3">
                <div class="d-flex align-items-center mb-1">
                  <textarea class="form-control" rows="4" id="ot_firmaResponsable" placeholder=""></textarea>
                </div>
                <label for="ot_firmaResponsable" class="form-label fw-bold text-center">FIRMA, ACLARACION Y SELLO DE AUTORIZACION</label>
              </div>
            </div>

            <hr class="my-1" />

          </div>

          <small class="form-text text-muted">FORMATO ELABORADO POR:ls/2022 /  Aprobado por Resolución S.G.N°239/2022</small>
        </div>
      </div>

      <div class="col-lg-12 col-12 mb-lg-0  mt-4">
        <div class="card invoice-preview-card" style="display: none;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 ">
                <div class="row">
                  <label for="ot_notaInterna" class="col-md-2 col-form-label">NOTAS INTERNAS:</label>
                  <div class="col-md-10">
                    <textarea class="form-control" rows="3" type="text" name="ot_notaInterna" id="ot_notaInterna"></textarea>
                    <small class="form-text text-muted">La información ingresada aquí es exclusivamente para uso interno y no será impresa.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

          <input type="hidden" name="identidadMovil" id="identidadMovil" value="">
          <input type="hidden" name="emisorOT" id="emisorOT" value="57">
          <input type="hidden" name="condOT1" id="condOT1" value="">
          <input type="hidden" name="condOT2" id="condOT2" value="">
          <input type="hidden" name="condOT3" id="condOT3" value="">
          <input type="hidden" name="condOT4" id="condOT4" value="">
          <input type="hidden" name="condOT5" id="condOT5" value="">
          <input type="hidden" name="trabajoOT1" id="trabajoOT1" value="">
          <input type="hidden" name="trabajoOT2" id="trabajoOT2" value="">
          <input type="hidden" name="trabajoOT3" id="trabajoOT3" value="">
          <input type="hidden" name="trabajoOT4" id="trabajoOT4" value="">
          <input type="hidden" name="trabajoOT5" id="trabajoOT5" value="">
          <input type="hidden" name="trabajoOT6" id="trabajoOT6" value="">
          <input type="hidden" name="trabajoOT7" id="trabajoOT7" value="">
          <input type="hidden" name="trabajoOT8" id="trabajoOT8" value="">
          <input type="hidden" name="trabajoOT9" id="trabajoOT9" value="">
          <input type="hidden" name="trabajoOT10" id="trabajoOT10" value="">
          <input type="hidden" name="ot-origen" id="ot-origen" value="">
          <input type="hidden" name="coberturaDistritosID" id="coberturaDistritosID" value="">
          <input type="hidden" name="otDistritoID" id="otDistritoID" value="">
      </div>
    </div>
  </div>
  <!-- /OT PREVIEW-->

  <!-- OT Actions -->
  <div class="col-xl-3 col-md-4 col-12 invoice-actions">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-paper-plane bx-xs me-1"></i>
            Enviar Orden de Trabajo
          </span>
        </button>
        <button class="btn btn-label-secondary d-grid w-100 mb-3">
          Descargar
        </button>
        {{-- <button id="boton-imprimir" class="btn btn-label-primary d-grid w-100 mb-3">
          Imprimir
        </button> --}}
        <a class="btn btn-label-secondary d-grid w-100 mb-3" target="_blank" href="{{url('app/ot/print')}}">
          Imprimir
        </a>
        <a href="{{url('app/ot/edit')}}" class="btn btn-label-primary d-grid w-100 mb-3">
          Editar Orden de Trabajo
        </a>
        <a href="{{url('app/ot/management')}}" class="btn btn-label-primary d-grid w-100 mb-3">
          Volver a Lista de OT
        </a>
      </div>
    </div>
  </div>
  <!-- /Invoice Actions -->
</div>

<!-- Offcanvas -->
@include('_partials/_offcanvas/offcanvas-send-invoice')
@include('_partials/_offcanvas/offcanvas-add-ot')
<!-- /Offcanvas -->
@endsection
