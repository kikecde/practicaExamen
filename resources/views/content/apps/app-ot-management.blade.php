@extends('layouts/layoutMaster')

@section('title', 'Gestión de Ordenes de Trabajo - Crud App')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-ot-management.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-add-ot.js')}}"></script>

@endsection

@section('content')

  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Ordenes de Trabajo</span>
              <div class="d-flex align-items-end mt-2">
                <h3 class="mb-0 me-2">{{$totalOT}}</h3>
                <small class="text-success">(100%)</small>
              </div>
              <small>Ordenes de Trabajo Registradas</small>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="bx bx-user bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>OT Cerradas</span>
              <div class="d-flex align-items-end mt-2">
                <h3 class="mb-0 me-2">{{$otFinalizado}}</h3>
                <small class="text-success">{{$porcentajeFinalizado}}%</small>
              </div>
              <small>Procesadas y enviadas</small>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="bx bx-user-check bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pendiente Impresión</span>
              <div class="d-flex align-items-end mt-2">
                <h3 class="mb-0 me-2">{{$otNoImpreso}}</h3>
                <small class="text-warning">{{$porcentajeNoImpreso}}%</small>
              </div>
              <small>Pendientes de Impresión/Firmas</small>
            </div>
            <span class="badge bg-label-danger rounded p-2">
              <i class="bx bx-group bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pendiente Remisión a UAdm</span>
              <div class="d-flex align-items-end mt-2">
                <h3 class="mb-0 me-2">{{$otNoEnviado}}</h3>
                <small class="text-danger">{{$porcentajeNoEnviado}}%</small>
              </div>
              <small>Finalización pendiente</small>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="bx bx-user-voice bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- OT List Table -->
  <div class="row mb-4">
    <div class="col-lg-12 col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Filtro de Búsqueda</h5>
          <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
            <div class="col-md-4 filtro_movil"></div>
            <div class="col-md-4 filtro_conductor"></div>
            <div class="col-md-4 filtro_status"></div>
          </div>
        </div>

        <div class="card-datatable table-responsive">
          <table class="datatables-ots table-sm border-top cell-border row-border">
            <thead>
              <tr>
                <th></th>
                <th>Nº</th>
                <th>MOVIL / OT Nº</th>
                <th>CONDUCTOR/ES</th>
                <th>FECHA EMISION OT</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
    <!--/ OT List Table -->



  <!-- Add ORDEN DE TRABAJO Sidebar -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="addOtOffcanvas"  aria-labelledby="offcanvasAddOTLabel">
    <div class="offcanvas-header mb-3">
      <h5 id="offcanvasAddOTLabel" class="offcanvas-title">Crear Orden de Trabajo</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body mx-0 flex-grow-0">

      <div class="d-flex justify-content-between bg-lighter p-2 mb-3 align-items-center">
        <i id="today-icon" class='bx bx-calendar-star' style='font-size: 30px; margin-right: 10px; cursor: pointer;' title="Marcar Hoy"></i>
        <input type="checkbox" class="switch-input" id="otHoy" style="display: none;">
        <input type="text" class="form-control" placeholder="DD/MM/AAAA" id="ot-fecha" name="ot-fecha"/>
      </div>

      <div class="d-flex justify-content-between bg-lighter p-2 mb-3 align-items-center">
        <i id="ambulance-icon" class='bx bxs-ambulance' style='font-size: 30px; margin-right: 10px; cursor: pointer;' title="Filtrar Operativos"></i>
        <input type="checkbox" class="switch-input" id="movilesOperativos" style="display: none;">
        <select class="form-select" id="movilOT">
          <option value="" selected disabled>Seleccione Móvil</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="otType">Tipo de Orden de Trabajo</label>
        <select class="form-select" id="otType">
          <option value="" selected disabled>Seleccionar Tipo de OT</option>
          <option value="1">Ordinario</option>
          <option value="2">Extraordinario</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="ot-fechaDesde" class="form-label">Fecha/Hora de Inicio</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="ot-fechaDesde"/>
      </div>
      <div class="mb-3">
        <label for="ot-fechaHasta" class="form-label">Fecha/Hora de Final</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="ot-fechaHasta" />
      </div>

      <div class="row d-flex  bg-lighter px-1 py-2 mb-3 mx-1 align-items-center">
        <div class="col-1 px-2">
            <i id="driver-icon" class='bx bxl-kubernetes' style='font-size: 30px; margin-right: 15px; cursor: pointer;' title="Filtrar de turno"></i>
        </div>
        <div class="col-11 ">
            <div >
                <input type="checkbox" class="switch-input" id="conductoresGuardia" style="display: none;">
                <select id="ot-conductoresSelect" name="ot-conductoresSelect" class="select2 form-select" style="width: 100%" lang="es" multiple>
                </select>
            </div>
        </div>
      </div>


      <div class="tab-content border mb-3  bg-lighter"  data-label="Localizaciones">
        <div class="mb-3">
          <label class="form-label" for="ot-origen">Origen Orden de Trabajo</label>
          <div class="input-group align-items-center">
            <i id="generic-icon" class='bx bxs-directions' style='font-size: 30px; margin-right: 10px; cursor: pointer;' title="Genérico"></i>
            <input type="checkbox" class="switch-input" id="distritosGenericos" style="display: none;">
            <select class="form-select" id="ot-origen" required>
              <option value="" selected disabled>Seleccionar Origen</option>
              <option value="1">Múltiples Establecimientos</option>
              <option value="2">Pedidos de Traslado</option>
              <option value="3">Logístico/Mecánico</option>
              <option value="4">Cobertura Evento</option>
              <option value="5">Atención Urgente/Emergente</option>
              <option value="6">Genérico</option>
            </select>
          </div>
        </div>


        <div class="mb-3" id="origenOpt1"  style="display: none;">
          <label for="ot-estabID0" class="form-label">Establecimiento/s</label>
          <select  name="ot-estabID0" id="ot-estabID0" aria-label="Establecimientos" class="select2 form-select" multiple>
          </select>
        </div>

        <div class="col mb-3" id="origenOpt2" style="display: none;">
          <div class="mb-12">
            <label for="ot-estabID1" class="form-label">Establecimiento Origen</label>
            <select  name="ot-estabID1" id="ot-estabID1" aria-label="Establecimiento Origen" class="select2 form-select">
              <option value="" selected disabled>Seleccione Establecimiento Origen</option>
            </select>
          </div>
          <div class="mb-12">
            <label for="ot-estabID2" class="form-label mt-2">Establecimiento Intermedio <span class="text-muted font-italic">(OPCIONAL)</span></label>
            <select  name="ot-estabID2" id="ot-estabID2" aria-label="Establecimiento Intermedio" class="select2 form-select">
              <option value="" selected disabled>Seleccione Establecimiento Origen</option>
            </select>
          </div>
          <div class="mb-12">
            <label for="ot-estabID3" class="form-label mt-2">Establecimiento Destino</label>
            <select  name="ot-estabID3" id="ot-estabID3" aria-label="Establecimiento Destino" class="select2 form-select">
              <option value="" selected disabled>Seleccione Establecimiento Destino</option>
            </select>
          </div>
        </div>

        <div class="col mb-3" id="origenOpt3" style="display: none;">
          <div class="mb-12">
            <label for="ot-estabID4" class="form-label">Distrito Destino</label>
            <select  name="ot-estabID4" id="ot-estabID4" aria-label="Distrito Log/Mec" class="select2 form-select" >
              <option value="" selected disabled>Seleccione Distrito Destino</option>
            </select>
          </div>
          <div class="mb-12">
            <label for="ot-estabID5" class="form-label">Ubicación/Local Destino</label>
            <input type="text"  name="ot-estabID5" id="ot-estabID5" aria-label="Ubicacion" class="form-control" placeholder="TALLER AUTORIZADO">
          </div>
        </div>

        <div class="col mb-3" id="origenOpt4" style="display: none;">
          <div class="mb-12">
            <label for="ot-estabID6" class="form-label">Distrito Destino</label>
            <select  name="ot-estabID6" id="ot-estabID6" aria-label="Distrito Cobertura" class="select2 form-select" >
              <option value="" selected disabled>Seleccione Distrito Destino</option>
            </select>
          </div>
          <div class="mb-12">
            <label for="ot-estabID7" class="form-label">Local Cobertura</label>
            <input type="text"  name="ot-estabID7" id="ot-estabID7" aria-label="Ubicacion Cobertura" class="form-control">
          </div>
        </div>

        <div class="col mb-3" id="origenOpt5" style="display: none;">
          <div class="mb-12">
            <label for="ot-estabID8" class="form-label">Distrito Destino</label>
            <select  name="ot-estabID8" id="ot-estabID8" aria-label="Distrito Urgencia/Emergencia" class="select2 form-select" >
              <option value="" selected disabled>Seleccione Distrito Destino</option>
            </select>
          </div>
          <div class="mb-12">
            <label for="ot-estabID9" class="form-label">Ubicación Urgencia/Emergencia</label>
            <input type="text"  name="ot-estabID9" id="ot-estabID9" aria-label="Ubicacion Urgencia/Emergencia" class="form-control">
          </div>
        </div>

        <div class="mb-3" id="origenOpt6"style="display: none;">
          <div id="coberturaDistrito">
            <select  class="form-select mb-3" id="coberturaDistritos">
              <option value="" selected >Seleccione Area de Cobertura</option>
              <option value="2">Interdistrital</option>
              <option value="1">Local</option>
              <option value="3">Regional</option>
              <option value="4">Interdepartamental</option>
              <option value="5">Nacional</option>
            </select>
            <div id="distrito-list" style="display:none;">
              <ul class="text-sm-left">
              </ul>
            </div>
          </div>

        </div>

      </div>
      <div class="mb-3" >
        <label for="ot_notaInterna" class="form-label">Nota Interna</label>
        <textarea class="form-control" rows="2" type="text" name="ot_notaInterna" id="ot_notaInterna"></textarea>
        <small class="form-text text-muted">La información ingresada en la Nota Interna es exclusivamente para uso interno y no será impresa.</small>
      </div>


      <form class="add-new-ot pt-0" id="addNewOTForm">
        <div>
          <input type="hidden" name="idOT" id="idOT" value="">
          <input type="hidden" name="fechaOT" id="fechaOT" value="" class="fecha">
          <input type="hidden" name="movilID" id="movilID" value="">
          <input type="hidden" name="ordinarioExtraordinario" id="ordinarioExtraordinario" value="">
          <input type="hidden" name="desdeOT" id="desdeOT" value="" class="fecha">
          <input type="hidden" name="hastaOT" id="hastaOT" value="" class="fecha">
          <input type="hidden" name="cond1OT" id="cond1OT" value="">
          <input type="hidden" name="cond2OT" id="cond2OT" value="">
          <input type="hidden" name="cond3OT" id="cond3OT" value="">
          <input type="hidden" name="cond4OT" id="cond4OT" value="">
          <input type="hidden" name="cond5OT" id="cond5OT" value="">

          <input type="hidden" name="otOrigenID" id="otOrigenID" value="" data-comment="Valor de Origen Orden de Trabajo">

          <input type="hidden" name="coberturaDistritoID" id="coberturaDistritoID" value=""  data-comment="Valor de Area de Cobertura Generica">
          <input type="hidden" name="otDistritoID" id="otDistritoID" value="" data-comment="Array Distritos Cobertura Generica">
          <input type="hidden" name="observacionInterna" id="observacionInterna" value="">
          <input type="hidden" name="emisorOT" id="emisorOT" value="57">



          <input type="hidden" name="chapaMovil" id="chapaMovil" value="">
          <input type="hidden" name="kmSalidaOT" id="kmSalidaOT" value="">
          <input type="hidden" name="kmLlegadaOT" id="kmLlegadaOT" value="">
          <input type="hidden" name="kmTotalOT" id="kmTotalOT" value="">
          <input type="hidden" name="consumoOT" id="consumoOT" value="">
          <input type="hidden" name="condOT" id="condOT" value="">
          <input type="hidden" name="kmEstimadoOT" id="kmEstimadoOT" value="">
          <input type="hidden" name="trabajoOT" id="trabajoOT" value="">

          <input type="hidden" name="trabajo1OT" id="trabajo1OT" value="">
          <input type="hidden" name="trabajo2OT" id="trabajo2OT" value="">
          <input type="hidden" name="trabajo3OT" id="trabajo3OT" value="">
          <input type="hidden" name="trabajo4OT" id="trabajo4OT" value="">
          <input type="hidden" name="trabajo5OT" id="trabajo5OT" value="">
          <input type="hidden" name="trabajo6OT" id="trabajo6OT" value="">
          <input type="hidden" name="trabajo7OT" id="trabajo7OT" value="">
          <input type="hidden" name="trabajo8OT" id="trabajo8OT" value="">
          <input type="hidden" name="trabajo9OT" id="trabajo9OT" value="">
          <input type="hidden" name="trabajo10OT" id="trabajo10OT" value="">






          <input type="hidden" name="vehiculo_tipo" id="vehiculo_tipo" value="">
          <input type="hidden" name="ot_conductoresCI" id="ot_conductoresCI" value="">
          <input type="hidden" name="vehiculo_ordenum" id="vehiculo_ordenum" value="">
          <input type="hidden" name="vehiculo_marca" id="vehiculo_marca" value="">
          <input type="hidden" name="vehiculo_modelo" id="vehiculo_modelo" value="">
          <input type="hidden" name="vehiculo_rasp" id="vehiculo_rasp" value="">
          <input type="hidden" name="ot_area" id="ot_area" value="">
          <input type="hidden" name="identidadMovil" id="identidadMovil" value="">

        </div>
        <div class="mb-3 d-flex flex-wrap">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
          <button type="button" class="btn btn-secondary me-sm-3 me-1" onclick="window.print();">Imprimir</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
  <!-- /Add OT Sidebar -->

@endsection
<!-- Offcanvas -->
{{-- @include('_partials/_offcanvas/offcanvas-send-invoice')
@include('_partials/_offcanvas/offcanvas-add-ot') --}}
<!-- /Offcanvas -->
