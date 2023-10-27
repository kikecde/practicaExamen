@extends('layouts/layoutMaster')

@section('title', 'Lista de Ordenes de Trabajo - APP')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
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
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-ot-list.js')}}"></script>
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
<div class="row">
  <div class="col-lg-9 col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Filtro de Búsqueda</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="datatables-ots table border-top">
          <thead>
            <tr>
              <th></th>
              <th>OT</th>
              <th>movil</th>
              <th>driver</th>
              <th>fecha</th>
              <th>acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>


  <!-- Offcanvas to add new movil -->
  <div class="col-lg-3 col-12 invoice-actions">
    <div class="card mb-4">
      <div class="card-body">
        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas" data-bs-target="#addOtOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bxs-file-plus bx-xs me-1"></i>Crear Orden de Trabajo</span>
        </button>
        <button class="btn btn-secondary d-grid w-100 mb-3">
          <span href="{{url('app/invoice/preview')}}" class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-desktop bx-xs me-1"></i>Previsualizar</span>
        </button>
        <button class="btn btn-secondary d-grid w-100 mb-3">
          <span id="scrape-button" class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-gas-pump bx-xs me-1"></i>Actualizar Saldos</span>
        </button>
      </div>
    </div>
    <div>
      <div class="d-flex justify-content-between mb-2">
        <label for="coberturaGenerica" class="mb-0">Cobertura Genérica</label>
        <label class="switch switch-primary me-0">
          <input type="checkbox" class="switch-input" id="coberturaGenerica" >
          <span class="switch-toggle-slider">
            <span class="switch-on">
              <i class="bx bx-check"></i>
            </span>
            <span class="switch-off">
              <i class="bx bx-x"></i>
            </span>
          </span>
          <span class="switch-label"></span>
        </label>
      </div>

      <div id="additional-options" style="display: none;">
        <div class="d-flex justify-content-between mb-2">
          <label for="movilesOperativos" class="mb-0">Solo Móviles operativos</label>
          <label class="switch switch-success me-0">
            <input type="checkbox" class="switch-input" id="movilesOperativos">
            <span class="switch-toggle-slider">
              <span class="switch-on">
                <i class="bx bx-check"></i>
              </span>
              <span class="switch-off">
                <i class="bx bx-x"></i>
              </span>
            </span>
            <span class="switch-label"></span>
          </label>
        </div>


        <div class="d-flex justify-content-between mb-2">
          <label for="conductoresGuardia" class="mb-0">Solo Conductores de Guardia</label>
          <label class="switch switch-primary me-0">
            <input type="checkbox" class="switch-input" id="conductoresGuardia">
            <span class="switch-toggle-slider">
              <span class="switch-on">
                <i class="bx bx-check"></i>
              </span>
              <span class="switch-off">
                <i class="bx bx-x"></i>
              </span>
            </span>
            <span class="switch-label"></span>
          </label>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <label for="fechaMañana" class="mb-0">Fecha Mañana</label>
          <label class="switch switch-primary me-0">
            <input type="checkbox" class="switch-input" id="fechaMañana">
            <span class="switch-toggle-slider">
              <span class="switch-on">
                <i class="bx bx-check"></i>
              </span>
              <span class="switch-off">
                <i class="bx bx-x"></i>
              </span>
            </span>
            <span class="switch-label"></span>
          </label>
        </div>
        <div class="d-flex justify-content-between">
          <label for="distritosGenericos" class="mb-0">Area de Cobertura Genérica</label>
          <label class="switch switch-primary me-0">
            <input type="checkbox" class="switch-input" id="distritosGenericos">
            <span class="switch-toggle-slider">
              <span class="switch-on">
                <i class="bx bx-check"></i>
              </span>
              <span class="switch-off">
                <i class="bx bx-x"></i>
              </span>
            </span>
            <span class="switch-label"></span>
          </label>
        </div>

        <div id="coberturaDistrito" style="display: none;">
          <select  class="form-select mb-3" >
            <option value="" selected >Seleccione Area de Cobertura</option>
            <option value="2" >Interdistrital</option>
            <option value="1">Local</option>
            <option value="3">Regional</option>
            <option value="4">Interdepartamental</option>
            <option value="5">Nacional</option>
          </select>
        <div id="local-list" style="display:none;">
          <ul>
              <li>CIUDAD DEL ESTE</li>
          </ul>
        </div>
        <div id="district-list" style="display:none;">
          <ul>
              <li>CIUDAD DEL ESTE</li>
              <li>HERNANDARIAS</li>
              <li>PRESIDENTE FRANCO</li>
              <li>MINGA GUAZU</li>
          </ul>
        </div>
        <div id="region-list" style="display:none;">
          <ul>
            <li>ALTO PARANÁ</li>

          </ul>
        </div>
        <div id="departamento-list" style="display:none;">
          <ul>
            <li>ALTO PARANA</li>
            <li>MISIONES</li>
            <li>CANINDEYU</li>
            <li>ITAPUA</li>
            <li>CAAGUAZU</li>
          </ul>
        </div>
        <div id="nacional-list" style="display:none;">
          <ul>
            <li>CORDILLERA</li>
            <li>SAN PEDRO</li>
            <li>PARAGUARI</li>
            <li>CENTRAL</li>
            <li>ASUNCION</li>
          </ul>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Add ORDEN DE TRABAJO Sidebar -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="addOtOffcanvas" aria-hidden="true" aria-labelledby="offcanvasAddOTLabel">
  <div class="offcanvas-header mb-3">
    <h5 id="offcanvasAddOTLabel" class="offcanvas-title">Crear Orden de Trabajo</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mx-0 flex-grow-0">
    <form class="add-new-ot pt-0" id="addNewOTForm">

      <div class="d-flex justify-content-between bg-lighter p-2 mb-3 align-items-center">
        <i class='bx bxs-ambulance' style='font-size: 30px; margin-right: 10px;'></i>
        <select class="form-select" id="movilOT">
          <option value="" selected disabled>Seleccione Móvil</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="ot-type">Tipo de Orden de Trabajo</label>
        <select class="form-select" id="ot-type">
          <option value="" selected disabled>Seleccionar Tipo de OT</option>
          <option value="1">Ordinario</option>
          <option value="2">Extraordinario</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="ot-conductoresSelect" class="form-label">Conductor/es</label>
        <select id="ot-conductoresSelect" name="ot-conductoresSelect" class="select2 form-select" multiple>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="ot-origen">Origen Orden de Trabajo</label>
        <select class="form-select" id="ot-origen">
          <option value="" selected disabled>Seleccionar Origen</option>
          <option value="1">Genérico</option>
          <option value="2">Pedidos de Traslado</option>
          <option value="2">Logístico/Mecánico</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="ot-fechaDesde" class="form-label">Fecha/Hora de Inicio</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="ot-fechaDesde" />
      </div>
      <div class="mb-3">
        <label for="ot-fechaHasta" class="form-label">Fecha/Hora de Final</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="ot-fechaHasta" />
      </div>
      <div class="mb-3">
        <label for="ot-estabID" class="form-label">Establecimiento/s</label>
        <select  name="ot-estabID" id="ot-estabID" aria-label="Establecimientos" class="select2 form-select" multiple>
        </select>
      </div>

      <div class="mb-3 d-flex flex-wrap">
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </div>

      <input type="hidden" name="idOT" id="idOT" value="">
      <input type="hidden" name="idMovil" id="idMovil" value="">
      <input type="hidden" name="identidadMovil" id="identidadMovil" value="">
      <input type="hidden" name="emisorOT" id="emisorOT" value="57">
      <input type="hidden" name="ot_conductores" id="ot_conductores" value="">
      <input type="hidden" name="condOT1" id="condOT1" value="">
      <input type="hidden" name="condOT2" id="condOT2" value="">
      <input type="hidden" name="condOT3" id="condOT3" value="">
      <input type="hidden" name="condOT4" id="condOT4" value="">
      <input type="hidden" name="condOT5" id="condOT5" value="">
      <input type="hidden" name="ot_trabajos" id="ot_trabajos" value="">
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
      <input type="hidden" name="fechaHoraDesdeOT" id="fechaHoraDesdeOT" value="">
      <input type="hidden" name="fechaHoraHastaOT" id="fechaHoraHastaOT" value="">
    </form>
  </div>
</div>
<!-- /Add OT Sidebar -->
@endsection
