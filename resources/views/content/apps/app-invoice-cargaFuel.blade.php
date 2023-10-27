@extends('layouts/layoutMaster')

@section('title', 'Agregar - Carga de Combustible')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-invoice.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

@endsection

@section('page-script')
<script src="{{asset('assets/js/offcanvas-add-carga.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-send-carga.js')}}"></script>
<script src="{{asset('assets/js/app-invoice-carga.js')}}"></script>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row invoice-add">
  <!-- Invoice Add-->
  <div class="col-lg-9 col-12 mb-lg-0 mb-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="row p-sm-3 p-0">
          <div class="col-md-12 mb-md-0 mb-4">
            <div class="header-image">
              <img src="{{asset('assets/img/branding/DECIMA_ADM.png')}}" alt="Encabezado" class="img-fluid"/>
          </div>
            <p class="mb-0 text-center">DGAF / DA / UMCSTC FORM Nº 002</p>
          </div>
        </div>

        <div class="bg-secondary d-flex align-items-center justify-content-center py-2">
          <h4 class="d-inline-block mb-0 text-dark"><strong> RECIBO DE CONTROL INTERNO N°: </strong></h4>
          <input type="text" class="d-inline-block mx-2 bg-secondary" name="orden_trabajo_num" id="orden_trabajo_num" value="" style="width: 10%; border: none; outline: none;">
        </div>

        <div class="row">

          <div class="d-flex align-items-center justify-content-center py-2">
            <h4 class="d-inline-block mb-0 text-dark"><strong> CIUDAD DEL ESTE, </strong></h4>
            <input type="text" class="d-inline-block mx-2" name="cargaDia" id="cargaDia" value="" >
            <h4 class="d-inline-block mb-0 text-dark"> DE </h4>
            <input type="text" class="d-inline-block mx-2 " name="cargaMes" id="cargaMes" value="" >
            <h4 class="d-inline-block mb-0 text-dark"> DEL AÑO </h4>
            <input type="text" class="d-inline-block mx-2 " name="cargaYear" id="cargaYear" value="" >
          </div>

          <div class="row d-flex align-items-center">
            <div class="col-md-6  mt-3 mb-2">
              <div class="mb-3 row align-items-center">
                <h4 for="cargaLitrosNro" class="col-md-4 col-form-label">RECIBI DE LA UNIDAD ADMINISTRATIVA, LA CANTIDAD DE </h4>
                <h4 for="cargaLitrosTexto" class="col-md-4 col-form-label">LITROS: </h4>
                <input type="text" class="d-inline-block mx-2" name="cargaLitrosNro" id="cargaLitrosNro" value="" >
                <h4 for="cargaGuaraniesNro" class="col-md-4 col-form-label">Gs. </h4>
                <input type="text" class="d-inline-block mx-2" name="cargaGuaraniesNro" id="cargaGuaraniesNro" value="" >
                <h4 for="cargaGuaraniesTexto" class="col-md-4 col-form-label">  (GUARANIES </h4>
                <input type="text" class="d-inline-block mx-2" name="cargaGuaraniesTexto" id="cargaGuaraniesTexto" value="" >
              </div>
            </div>
            <div class="col-md-6  mt-3 mb-2">
              <div class="mb-3 row align-items-center">
                <h4 for="cargaTipoCombus" class="col-md-4 col-form-label">DE COMBUSTIBLE (</h4>
                <input type="text" class="d-inline-block mx-2" name="cargaTipoCombus" id="cargaTipoCombus" value="" >
                <h4 for="cargaGuaraniesTexto" class="col-md-4 col-form-label">  ), NUMERO DE TICKET: </h4>
              </div>
            </div>
          </div>

          <div class="row d-flex align-items-center">
            <div class="col-md-12 mb-2">
              <div class="mb-3 row align-items-center">
                <label for="cargaArea" class="col-md-6 col-form-label">PARA REALIZAR TRABAJOS EN </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="cargaArea" id="cargaArea" />
                </div>
              </div>
            </div>
          </div>

          <div class="row d-flex align-items-center">
            <div class="col-md-12 mb-2">
              <div class="mb-3 row align-items-center">
                <label for="cargaOT" class="col-md-6 col-form-label">SEGUN ORDEN DE TRABAJO N°:</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="cargaOT" id="cargaOT" />
                </div>
              </div>
            </div>
          </div>

          <div class="row d-flex align-items-center">
            <div class="col-md-12 mb-2">
              <div class="mb-3 row align-items-center">
                <label for="ot_area" class="col-md-3 col-form-label text-end">NÚMERO DE TARJETA ASIGNADA:</label>
                <div class="col-md-9">
                  <input class="form-control" type="text" name="ot_area" id="ot_area" />
                </div>
              </div>
            </div>
          </div>

          <div class="row d-flex align-items-center">
            <div class="col-md-8 mb-2">
              <div class="mb-3 row align-items-center">
                <label for="ot_conductores" class="col-md-3 col-form-label">CÓDIGO DE AUTORIZACIÓN N°:</label>
                <div class="col-md-9">
                  <textarea id="ot_conductores" rows="1" class="form-control" ></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-secondary d-flex align-items-center justify-content-center py-2">
            <h4 class="d-inline-block mb-0 text-dark"><strong> RECIBÍ CONFORME (CONDUCTOR) </strong></h4>
            <input type="text" class="d-inline-block mx-2 bg-secondary" name="cargaConductor" id="cargaConductor" value="" style="width: 10%; border: none; outline: none;">
          </div>

          <div class="row d-flex align-items-center">
            <div class="row d-flex align-items-center">
              <div class="col-md-6  mt-3 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="cargaAclaracion" class="col-md-4 col-form-label">ACLARACIÓN:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="cargaAclaracion" id="cargaAclaracion" />
                  </div>
                </div>
              </div>
              <div class="col-md-6  mt-3 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="cargaFirma" class="col-md-4 col-form-label text-end">FIRMA:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="cargaFirma" id="cargaFirma" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row d-flex align-items-center">
            <div class="row d-flex align-items-center">
              <div class="col-md-6  mt-3 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="cargaCI" class="col-md-4 col-form-label">C.I. Nº:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="cargaCI" id="cargaCI" />
                  </div>
                </div>
              </div>
              <div class="col-md-6  mt-3 mb-2">
                <div class="mb-3 row align-items-center">
                  <label for="cargaFecha" class="col-md-4 col-form-label text-end">FECHA:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="cargaFecha" id="cargaFecha" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row d-flex align-items-center">
            <div class="col-md-12 mb-2">
              <div class="mb-3 row">
                <label for="vehiculo_ordenum" class="col-md-12 col-form-label fw-bold">Vº Bº DE LA DEPENDENCIA SOLICITANTE:</label>
                <input class="form-control" type="text" name="cargaVtoBno" id="cargaVtoBno" />
              </div>
            </div>
          </div>

          <hr class="my-1" />

          <small class="form-text text-muted">ORIGINAL: UNIDAD ADMINISTRATIVA</small>
          <small class="form-text text-muted">COPIA: TRANSPORTE</small>

          <hr class="my-1" />

        </div>
        <small class="form-text text-muted">FORMATO ELABORADO POR:ls/2022 /  Aprobado por Resolución S.G.N°239/2022</small>
      </div>
    </div>

    <div class="col-lg-12 col-12 mb-lg-0  mt-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 ">
              <div class="row">
                <label for="carga_notaInterna" class="col-md-2 col-form-label">NOTAS INTERNAS:</label>
                <div class="col-md-10">
                  <textarea class="form-control" rows="3" type="text" name="carga_notaInterna" id="carga_notaInterna"></textarea>
                  <small class="form-text text-muted">La información ingresada aquí es exclusivamente para uso interno y no será impresa.</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Invoice Add-->



  <!-- Invoice Actions -->
  <div class="col-lg-3 col-12 invoice-actions">
    <div class="card mb-4">
      <div class="card-body">
        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas" data-bs-target="#addCargaOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bxs-file-plus bx-xs me-1"></i>Generar Recibo de Combustible</span>
        </button>
        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas" data-bs-target="#sendCargaOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-paper-plane bx-xs me-1"></i>Enviar Recibo de Combustible</span>
        </button>
        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-target="#sendCargaOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-save bx-xs me-1"></i>Guardar Recibo de Combustible</span>
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
        <label for="otPendientes" class="mb-0">Orden de Trabajo pendientes</label>
        <label class="switch switch-primary me-0">
          <input type="checkbox" class="switch-input" id="otPendientes" >
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
          <label for="conductoresOT" class="mb-0">Conductores en OT</label>
          <label class="switch switch-primary me-0">
            <input type="checkbox" class="switch-input" id="conductoresOT">
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
          <option value="2" selected >Interdistrital</option>
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
            <li>CIUDAD DEL ESTE</li>
            <li>COLONIA YGUAZU</li>
            <li>DOMINGO MARTINEZ DE IRALA</li>
            <li>DR. RAUL PEÑA</li>
            <li>HERNANDARIAS</li>
            <li>IRUÑA</li>
            <li>ITAKYRY</li>
            <li>JUAN E O LEARY</li>
            <li>JUAN LEÓN MALLORQUIN</li>
            <li>LOS CEDRALES</li>
            <li>MBARACAYU</li>
            <li>MINGA GUAZU</li>
            <li>MINGA PORA</li>
            <li>ÑACUNDAY</li>
            <li>NARANJAL</li>
            <li>PRESIDENTE FRANCO</li>
            <li>SAN ALBERTO</li>
            <li>SAN CRISTOBAL</li>
            <li>SANTA FE DEL PARANA</li>
            <li>SANTA RITA</li>
            <li>SANTA ROSA DEL MONDAY</li>
            <li>TAVAPY</li>
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
  <!-- /Invoice Actions -->

</div>

<!-- Offcanvas -->
@include('_partials/_offcanvas/offcanvas-send-invoice')
@include('_partials/_offcanvas/offcanvas-add-ot')
<!-- /Offcanvas -->
@endsection


<style>
  .sm-font-size {
      font-size: 18px; /* Ajusta este valor según lo necesario */
  }
</style>
