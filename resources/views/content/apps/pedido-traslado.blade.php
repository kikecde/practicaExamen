@extends('layouts/layoutMaster')

@section('title', 'Pedidos - Traslados/Estudios')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/nouislider/nouislider.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />

<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<!-- Row Group CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}">
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/wNumb/wNumb.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/nouislider/nouislider.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/tables-datatables-basic4.js')}}"></script>
<script src="{{asset('assets/js/pedido-traslado.js')}}"></script>

@endsection


@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Pedido de Traslado /</span> Generar
</h4>

<!-- Formulario de Pedido de Traslado -->
<div id="wizard-modern-pedido" class="bs-stepper wizard-modern mt-2">
  <div class="bs-stepper-header">
    <div class="step" data-target="#info-traslado">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-user'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Información de Traslado</span>
          <span class="bs-stepper-subtitle">Selección de Solicitud</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#info-medica">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bxs-thermometer'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Estado del Paciente</span>
          <span class="bs-stepper-subtitle">Información Médica</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#info-estudio">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bxs-flask'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Estudio/Procedimiento</span>
          <span class="bs-stepper-subtitle">Establecimiento y Servicios</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#info-destino">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-map'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Destino de Traslado</span>
          <span class="bs-stepper-subtitle">Detalles Itinerario</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#alta-detalles">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-home'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Datos para Altas</span>
          <span class="bs-stepper-subtitle">Ubicación Domicilio</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#confirmar-cancelar">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-message-check'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Resumen/Confirmar Pedido</span>
          <span class="bs-stepper-subtitle">Conformidad y responsabilidad</span>
        </span>
      </button>
    </div>
  </div>

  <div class="bs-stepper-content">
    <form id="wizard-modern-pedido-form" onSubmit="return false">

      <!-- Detalles Traslado -->
      <div id="info-traslado" class="content">
        <div class="row g-3">
          <div class="col-12">
            <div class="row">
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="tipoTraslado1">
                    <span class="custom-option-body">
                      <div style="display: flex; justify-content: center;">
                        <i class="bx bxs-clinic"></i>
                        <i class="bx bxs-ambulance bx-fade-right-hover" style="margin-right: 10px;"></i>
                        <i class="bx bx-clinic"></i>
                      </div>
                        <span class="custom-option-title">Referencia / Contrarreferencia</span>
                        <small>Solicite Traslado de paciente a otro establecimiento.</small>
                    </span>
                    <input name="tipoTraslado" class="form-check-input" type="radio" value="1" id="tipoTraslado1"  />
                  </label>
                </div>
              </div>
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="tipoTraslado2">
                    <span class="custom-option-body">
                      <div style="display: flex; justify-content: center;">
                        <i class="bx bxs-clinic"></i>
                        <i class="bx bxs-ambulance bx-fade-right-hover" style="margin-right: 10px;"></i>
                        <i class="bx bxs-vial"></i>
                      </div>
                        <span class="custom-option-title">Estudios / Procedimientos</span>
                        <small> Solicite Estudio/Procedimiento + Traslado. </small>
                    </span>
                    <input name="tipoTraslado" class="form-check-input" type="radio" value="2" id="tipoTraslado2" />
                  </label>
                </div>
              </div>
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="tipoTraslado3">
                    <span class="custom-option-body">
                      <div style="display: flex; justify-content: center;">
                        <i class="bx bxs-clinic"></i>
                        <i class="bx bxs-ambulance bx-fade-right-hover" style="margin-right: 10px;"></i>
                        <i class="bx bx-home"></i>
                      </div>
                        <span class="custom-option-title">Alta Domiciliar</span>
                        <small>Solicite Traslado de pacientes con alta domiciliar.</small>
                    </span>
                    <input name="tipoTraslado" class="form-check-input" type="radio" value="3" id="tipoTraslado3" />
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label d-block" for="estabOrigen">Origen del Pedido</label>
            <div class="row">
                <div class="col-sm-4">
                    <select class="select2 form-select" name="estabOrigenID" id="estabOrigenID" aria-label="Establecimiento de Origen">
                        <option value="" selected>Seleccione Establecimiento</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="select2 form-select" name="servicioOrigenID" id="servicioOrigenID" aria-label="Servicio de Origen">
                        <option value="" selected>Seleccione Servicio</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="select2 form-select" name="sectorOrigenID" id="sectorOrigenID" aria-label="Sector de Origen">
                        <option value="" selected>Seleccione Sector</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="profesionalOrigenCI">CI Profesional Origen</label>
            <input type="number" id="profesionalOrigenCI" name="profesionalOrigenCI" class="form-control" placeholder="Su Cedula de Identidad" />
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="profesionalOrigenTel">Teléfono Profesional Origen</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">+595 9</span>
              <input type="text" id="profesionalOrigenTel" name="profesionalOrigenTel" class="form-control fono-mask" placeholder="83 123 456" />
            </div>
          </div>

          <div class="divider">
            <div class="divider-text fw-bold mt-4">Paciente</div>
          </div>

          <div class="col-sm-6">
            <label class="form-label" for="pacienteCI">Cedula de Identidad Paciente</label>
            <input type="number" id="pacienteCI" name="pacienteCI" class="form-control" placeholder="Dejar en blanco si no posee" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteNyA">Nombre y Apellido Paciente</label>
            <input type="text" id="pacienteNyA" name="pacienteNyA" class="form-control" placeholder="Ingresar Nombre y Apellido" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteSexo">Sexo Paciente</label>
            <select id="pacienteSexo" name="pacienteSexo" class="select2 form-select" data-allow-clear="true">
              <option value="">Seleccione</option>
              <option value="1">MASCULINO</option>
              <option value="2">FEMENINO</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteFNAC">Fecha de Nacimiento Paciente</label>
            <input type="text" id="pacienteFNAC" placeholder="DD/MM/YYYY" class="form-control" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteTel">Telefono Paciente o Familiar</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">+595 9</span>
              <input type="text" id="pacienteTel" name="pacienteTel" class="form-control fono-mask" placeholder="83 123 456" />
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteAPP">Antecedentes Patológicos</label>
            <input id="pacienteAPP" name="pacienteAPP" class="form-control" placeholder="Seleccione uno o mas APPs">
          </div>
          <div class="col-sm-12">
            <label class="form-label">Acompañamiento desde Origen</label>
            <div class="row">
              <div class="col-sm-4">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="acompaFliar" id="acompaFliar">
                      <label class="form-check-label" for="acompaFliar">Familiar (max 1 persona)</label>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="acompaMed" id="acompaMed">
                      <label class="form-check-label" for="acompaMed">Médico</label>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="acompaEnf" id="acompaEnf">
                      <label class="form-check-label" for="acompaEnf">Enfermero/Paramédico</label>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" disabled> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Anterior</span>
            </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>

      <!-- Detalles Clinicos -->
      <div id="info-medica" class="content">
        <div class="row g-3">
          <div class="col-12">
            <div class="row">
              <div class="col mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="tiempoTraslado1">
                    <span class="custom-option-body">
                      <i class="bx bx-alarm-exclamation bx-tada text-danger"></i>
                      <span class="custom-option-title">Traslado Urgente</span>
                      <small>Exclusivamente si la gravedad del paciente requiere prioridad.<br />
                        <span class="text-danger">Utilice con criterio.</span>
                      </small>
                    </span>
                    <input name="tiempoTraslado" class="form-check-input" type="radio" value="1" id="tiempoTraslado1" />
                  </label>
                </div>
              </div>
              <div class="col mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="tiempoTraslado2">
                    <span class="custom-option-body">
                        <i class="bx bx-calendar text-success"></i>
                        <span class="custom-option-title">Traslado Programado</span>
                        <small>Marque esta opción si el traslado/estudio puede ser agendado.<br />
                            <span class="text-danger">Hasta 03 horas previas a agendamiento.</span>
                        </small>
                    </span>
                    <!-- Contenedor Flexbox para el radio button y el input de fecha/hora -->
                    <div class="d-flex align-items-center justify-content-center" id="radioContainer">
                      <input name="tiempoTraslado" class="form-check-input" type="radio" value="2" id="tiempoTraslado2" />
                      <!-- Input de fecha al lado del radio button -->
                      <input type="text" class="form-control-sm border-primary" placeholder="DD/MM/AAAA HH:MM" name="estudioHoraPreAg" id="estudioHoraPreAg" style="display: none; style= margin-left: 10px;" />
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteGRV">Gravedad del paciente</label>
            <select id="pacienteGRV" name="pacienteGRV" class="select2 form-select" data-allow-clear="true">
              <option value="">Seleccione Gravedad</option>
              <option value="1">Muy Estable</option>
              <option value="2">Estable</option>
              <option value="3">Inestable</option>
              <option value="4">Grave</option>
              <option value="5">Crítico</option>
            </select>
          </div>
          <div class="col-sm-6 mt-5">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="pacienteIndicacionesSi" id="pacienteIndicacionesSi">
              <label class="form-check-label" for="pacienteIndicacionesSi">Requiere Indicaciones Médicas para el Traslado</label>
            </div>
          </div>
          <div class="col-sm-12">
            <label class="form-label" for="pacienteDXs">Diagnostico/s</label>
            <input type="text" id="pacienteDXs" name="pacienteDXs" class="form-control" placeholder="TCE GRAVE, FX MSI" />
          </div>
          <div class="col-sm-12">
            <label class="form-label" for="pacienteSV">Signos Vitales</label>
            <div class="input-group mb-3">
              <span class="input-group-text text-bg-danger" id="pacienteSV-PresionArterial">PA</span>
              <input type="text" class="form-control" placeholder="120/80 mm/Hg" aria-label="Presión Arterial" aria-describedby="basic-addon11" />
              <span class="input-group-text text-bg-danger" id="pacienteSV-FrecuenciaCardiaca">FC</span>
              <input type="text" class="form-control" placeholder="40 - 250 LPM" aria-label="Frecuencia Cardíaca" aria-describedby="basic-addon11" />
              <span class="input-group-text text-bg-danger" id="pacienteSV-FrecuenciaRespiratoria">FR</span>
              <input type="text" class="form-control" placeholder="5 - 30 RPM" aria-label="Frecuencia Respiratoria" aria-describedby="basic-addon11" />
              <span class="input-group-text text-bg-danger" id="pacienteSV-SatO2">SatO2</span>
              <input type="text" class="form-control" placeholder="40% - 99%" aria-label="Saturación O2" aria-describedby="basic-addon11" />
            </div>
            <div class="noUi-danger my-4 mb-5" id="presionArterial"></div>
            <div class="noUi-primary my-4 mb-5" id="frecuenciaCardiaca"></div>
            <div class="noUi-success my-4 mb-5" id="frecuenciaRespiratoria"></div>
            <div class="noUi-green my-4 mb-5" id="satO2"></div>

            <div class="input-group my-3">
              <span class="input-group-text text-bg-danger" id="pacienteSV-Glasgow">Glasgow</span>
              <input type="text" class="form-control" placeholder="1 - 15" aria-label="GLASGOW" aria-describedby="basic-addon11" />
              <span class="input-group-text text-bg-danger" id="pacienteSV-TAX">TAX</span>
              <input type="text" class="form-control" placeholder="33ºC- 43ºC" aria-label="TAX" aria-describedby="basic-addon11" />
              <span class="input-group-text text-bg-danger" id="pacienteSV-GLC">GLC</span>
              <input type="text" class="form-control" placeholder="40 - 540 mg/dL" aria-label="Glicemia" aria-describedby="basic-addon11" />
            </div>
            <div class="noUi-info my-4 mb-3" id="glasgow"></div>
            <div class="noUi-warning my-4 mb-3" id="tax"></div>
            <div class="noUi-dark my-4 mb-3" id="glicemia"></div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteO2">Soporte O2</label>
            <div class="input-group ">
              <select class="form-select col-8 text-bg-info" id="pacienteO2" aria-label="Tipo de Soporte">
                <option value=0 selected>Sin Soporte O2</option>
                <option value=10>Cánula Nasal</option>
                <option value=20>Mascarilla Simple</option>
                <option value=21>Mascarilla c/ Reservorio</option>
                <option value=22>Mascarilla Venturi</option>
                <option value=30>Cánula de Mayo</option>
                <option value=40>CPAP</option>
                <option value=50>Cánula Alto Flujo</option>
                <option value=60>IOT</option>
                <option value=61>INT</option>
                <option value=62>TQT</option>
              </select>
              <input type="number" class="form-control col-2" aria-label="Flujo litros/min" placeholder="litros/min">
              <span class="input-group-text col-2 text-bg-gray" id="paciente-O2-lmin">l/min</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="pacienteHP">Hidratación Parenteral</label>
            <div class="input-group">
              <!-- HP -->
              <label class="input-group-text text-bg-warning" for="hp01">HP</label>
              <select class="form-select col-6" id="hp01">
                <option selected>Seleccionar</option>
                <option value="1">Via Cerrada</option>
                <option value="2">SF al 0,9%</option>
                <option value="3">SGlc al 5%</option>
                <option value="3">Ringer Lactato</option>
              </select>

              <!-- Goteo -->
              <label class="input-group-text text-bg-warning" for="hp02">Goteo</label>
              <input type="number" class="form-control col-2" id="hp02" aria-label="gotas/min" placeholder="gotas/min">

              <!-- Selector de tipo de goteo -->
              <select class="form-select col-4 text-bg-gray" id="hp03" aria-label="Tipo de goteo">
                <option value="1">macrogotas/min</option>
                <option value="2">microgotas/min</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12">
            <label class="form-label" for="pacienteComplej">Complejización</label>
            <input id="pacienteComplej" name="pacienteComplej" class="form-control" placeholder="Seleccione complejizaciones del paciente">
          </div>
          <!-- DataTable with Buttons
          <div id="datatable-container" style="display: none;">

            <div class="card">
              <div class="card-datatable table-responsive">
                <table class="datatables-basic table border-top">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>id</th>
                      <th>Fármaco</th>
                      <th>Dosis</th>
                      <th>Via</th>
                      <th>Administración</th>
                      <th>Observación</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>


          </div>
          DataTable with Buttons -->
          <div class="col-sm-12">
            <label class="form-label" for="pacienteAdicional">Información Adicional</label>
            <textarea id="pacienteAdicional" name="pacienteAdicional" class="form-control" rows="2" placeholder="Agregue información adicional relevante"></textarea>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Anterior</span> </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>
      <!-- Modal to add new record
      <div class="offcanvas offcanvas-end" id="add-new-indicacion">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="exampleModalLabel">Agregar Indicación</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
          <form class="add-new-indicacion pt-0 row g-2" id="form-add-new-indicacion" onsubmit="return false">
            <div class="col-sm-12">
              <label class="form-label" for="indicacionTipo">Tipo de Indicación</label>
              <div class="input-group input-group-merge">
                <span id="indicacionTipo2" class="input-group-text"><i class="bx bx-food-menu"></i></span>
                <select id="indicacionTipo" class="form-select dt-indicacionTipo" >
                  <option value="">Seleccione</option>
                  <option value="1">General</option>
                  <option value="2">A horario</option>
                  <option value="3">Continuo</option>
                  <option value="4">Segun Necesidad</option>
                  <option value="5">Emergente</option>
                  <option value="6">Horario y S/N</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionDroga">Farmaco</label>
              <div class="input-group input-group-merge">
                <span id="indicacionDroga2" class="input-group-text"><i class="bx bxs-capsule"></i></span>
                <input type="text" id="indicacionDroga" class="form-control dt-indicacionDroga" name="indicacionDroga" placeholder="Seleccione" aria-label="Ketorolac" aria-describedby="basicDrugName2" />
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionConcentracion">Concentración</label>
              <div class="input-group input-group-merge">
                <span id="indicacionConcentracion2" class="input-group-text"><i class='bx bx-ruler'></i></span>
                <input type="text" id="indicacionConcentracion" name="indicacionConcentracion" class="form-control dt-indicacionConcentracion" placeholder="Concentracion" aria-label="concentracion" aria-describedby="basicConcentracion2" />
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionDosisCantidad">Dosis</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bxs-vial"></i></span>
                <input type="number" id="indicacionDosisCantidad" name="indicacionDosisCantidad" class="form-control dt-indicacionDosisCantidad" placeholder="Ingrese" aria-label="dosis.droga" />
                <select id="indicacionDosisMedida" class="form-select dt-indicacionDosisMedida" >
                  <option value="">Medida</option>
                  <option value=" ampolla/s">ampolla/s</option>
                  <option value=" ml">ml</option>
                  <option value=" gamma">gamma</option>
                  <option value=" comprimido/s">comprimido/s</option>
                  <option value=" gotas">gotas</option>
                  <option value=" disparos">disparos</option>
                </select>
              </div>
              <div class="form-text">
                Ingrese dosis calculada por concentración.
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionVia">Via de Administración</label>
              <div class="input-group input-group-merge">
                <span id="indicacionVia2" class="input-group-text"><i class='bx bx-injection'></i></span>
                <select id="indicacionVia" class="form-select dt-indicacionVia">
                  <option value="">Seleccione</option>
                  <option value="1">ET</option>
                  <option value="2">IM</option>
                  <option value="3">SC</option>
                  <option value="4">VO</option>
                  <option value="5">SL</option>
                  <option value="6">AEC</option>
                  <option value="7">Nas</option>
                  <option value="8">Rect</option>
                  <option value="9">Ocu</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionDilucion">Dilución</label>
              <div class="input-group input-group-merge">
                <span id="indicacionDilucion2" class="input-group-text"><i class='bx bxs-vial'></i></span>
                <input type="number" id="indicacionDilucion" name="indicacionDilucion" class="form-control dt-indicacionDilucion" placeholder="Cantidad" aria-label="10" aria-describedby="basicDilucion2" />
                <span class="input-group-text">ml</span>
                <select id="indicacionDiluyente" class="form-select dt-indicacionDiluyente">
                  <option value="">de (diluyente)</option>
                  <option value="ml SF 0,9%">SF 0,9%</option>
                  <option value="ml SGlc 0,5%">SGlc 0,5%</option>
                  <option value="ml SGlc 50%">SGlc 50%</option>
                  <option value="ml RL">RL</option>
                  <option value="ml Agua Destilada">Agua Dest.</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionMetodo">Administración</label>
              <div class="input-group input-group-merge">
                <span id="indicacionMetodo2" class="input-group-text"><i class='bx bxs-vial'></i></span>
                <select id="indicacionMetodo" class="form-select dt-indicacionMetodo">
                  <option value="">Seleccione</option>
                  <option value="1">En bolo</option>
                  <option value="2">Infusión Rápida</option>
                  <option value="3">Infusión Lenta</option>
                  <option value="4">Infusión Continua</option>
                </select>
                <select id="indicacionTiempo" class="form-select dt-indicacionTiempo">
                  <option value="">Durante</option>
                  <option value="3 min">3 min</option>
                  <option value="5 min">5 min</option>
                  <option value="10 min">10 min</option>
                  <option value="15 min">15 min</option>
                  <option value="20 min">20 min</option>
                  <option value="30 min">30 min</option>
                  <option value="1 hora">1 hora</option>
                  <option value="2 horas">2 horas</option>
                  <option value="3 horas">3 horas</option>
                  <option value="4 horas">4 horas</option>
                  <option value="5 horas">5 horas</option>
                  <option value="6 horas">6 horas</option>
                  <option value="7 horas">7 horas</option>
                  <option value="8 horas">8 horas</option>
                  <option value="9 horas">9 horas</option>
                  <option value="10 horas">10 horas</option>
                  <option value="11 horas">11 horas</option>
                  <option value="12 horas">12 horas</option>
                  <option value="13 horas">13 horas</option>
                  <option value="14 horas">14 horas</option>
                  <option value="15 horas">15 horas</option>
                  <option value="16 horas">16 horas</option>
                  <option value="17 horas">17 horas</option>
                  <option value="18 horas">18 horas</option>
                  <option value="19 horas">19 horas</option>
                  <option value="20 horas">20 horas</option>
                  <option value="21 horas">21 horas</option>
                  <option value="22 horas">22 horas</option>
                  <option value="23 horas">23 horas</option>
                  <option value="24 horas">24 horas</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="indicacionObservacion">Observaciones</label>
              <div class="input-group input-group-merge">
                <span id="indicacionObservacion2" class="input-group-text"><i class="bx bx-capsule"></i></span>
                <input type="text" id="indicacionObservacion" class="form-control dt-indicacionObservacion" name="indicacionObservacion" placeholder="Seleccione" aria-label="Adicional" aria-describedby="basicObservacion2" />
              </div>
            </div>

            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Guardar</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
            </div>
          </form>

        </div>
      </div>
      fin modal-->

      <!-- Info de Estudios y Procedimientos -->
      <div id="info-estudio" class="content">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label d-block" for="estudioEstID">Establecimiento para Estudio/Procedimiento</label>
            <select id="estudioEstID" name="estudioEstID" class="form-control">
                <option selected>Seleccione Establecimiento</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="estudioProfID">Profesional solicitado (si corresponde)</label>
            <input type="text" id="estudioProfID" name="estudioProfID" class="form-control" placeholder="Dra. Marie Curie" />
          </div>
          <div class="col-sm-12">
            <label class="form-label d-block" for="estudioJustifica">DX / Imp. DX / Motivo de Consulta</label>
            <input type="text" id="estudioJustifica" name="estudioJustifica" class="form-control" placeholder="Caida de propia altura - Deformidad en antebrazo" />
          </div>
          <div class="divider">
            <div class="divider-text">Estudios / Procedimientos</div>
          </div>
          <div class="col-12">
                <div class="form-repeater">
                  <div data-repeater-list="group-a">
                    <div data-repeater-item>
                      <div class="row">
                        <div class="col-sm-3">
                          <label class="form-label" for="estudioID">Estudio</label>
                          <select name="estudioID" class="form-control estudioID">
                              <option selected>Seleccione estudios</option>
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <label class="form-label" for="forma-repeater-1-1">Especificaciones 1</label>
                          <input type="text" id="forma-repeater-1-1" class="form-control" placeholder="Ej: Contrastada" />
                        </div>
                        <div class="col-sm-4">
                          <label class="form-label" for="forma-repeater-1-2">Especificaciones 2</label>
                          <input type="text" id="forma-repeater-1-2" class="form-control" placeholder="Ej: Torax PA y Lateral" />
                        </div>
                        <div class="col-sm-2">
                          <button class="btn btn-label-danger mt-4" data-repeater-delete>
                            <i class="bx bx-x me-1"></i>
                            <span class="align-middle">Eliminar</span>
                          </button>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="mb-0">
                    <button class="btn btn-primary" data-repeater-create>
                      <i class="bx bx-plus me-1"></i>
                      <span class="align-middle">Agregar</span>
                    </button>
                  </div>
                </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label" for="estudioAdicional">Información Adicional</label>
            <input type="text" id="estudioAdicional" name="estudioAdicional" class="form-control" placeholder="Agregue información adicional relevante" >
          </div>
          <div class="divider">
            <div class="divider-text">Destino</div>
          </div>
          <div class="col-sm-12">
            <label class="switch switch-success">
              <input type="checkbox" name="retornoOrigen" class="switch-input" id="retornoOrigen"  />
              <span class="switch-toggle-slider">
                <span class="switch-on">
                  <i class="bx bx-check"></i>
                </span>
                <span class="switch-off">
                  <i class="bx bx-x"></i>
                </span>
              </span>
              <span class="switch-label">Al finalizar, retorno a Establecimiento/Servicio/Sector Origen?</span>
            </label>
          </div>
          <div class="col-sm-12">
            <label class="form-label d-block" for="estabDestinoID">Establecimiento Destino</label>
            <div class="input-group input-group-merge" >
              <select class="form-select" id="estabDestinoID" aria-label="Establecimiento de Destino">
                <option value= "" selected>Seleccione Establecimiento</option>
              </select>
              <select class="form-select" id="servicioDestinoID" aria-label="Servicio de Destino">
                <option value= "" selected>Seleccione Servicio</option>
              </select>
              <select class="form-select" id="sectorDestinoID" aria-label="Sector de Destino">
                <option value= "" selected>Seleccione Sector</option>
              </select>
            </div>
          </div>


          <div class="col-sm-6">
            <label class="form-label d-block" for="profesionalDestinoEstudio">Profesional Destino</label>
            <div class="input-group">
              <span class="input-group-text text-bg-primary" for="profesionalDestinoID">Dr./Dra.</span>
              <input type="text" class="form-control col-sm-8" placeholder="Nombre y Apellido" id="profesionalDestinoNyA" aria-label="Profesional Estudio Destino" aria-describedby="profesionalEstudioDestino" />
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="profesionalDestinoTel">Teléfono Profesional Destino</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">+595 9</span>
              <input type="text" id="profesionalDestinoTel" name="profesionalDestinoTel" class="form-control fono-mask" placeholder="83 123 456" />
            </div>
          </div>

          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Anterior</span> </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>

      <!-- Info Destino -->
      <div id="info-destino" class="content">
        <div class="row g-3">
          <div class="col-sm-12">
            <label class="form-label d-block" for="estabDestinoIDTR">Establecimiento Destino</label>
            <div class="input-group input-group-merge">
              <select class="form-select" id="estabDestinoIDTR" aria-label="Establecimiento de Destino">
                <option selected>Seleccione Establecimiento</option>
              </select>
              <select class="form-select" id="servicioDestinoIDTR" aria-label="Servicio de Destino">
                <option selected>Seleccione Servicio</option>
              </select>
              <select class="form-select" id="sectorDestinoIDTR" aria-label="Sector de Destino">
                <option selected>Seleccione Sector</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="profesionalDestinoTR">Profesional Destino</label>
            <div class="input-group">
              <span class="input-group-text text-bg-primary" for="profesionalDestinoIDTR">Dr./Dra.</span>
              <input type="text" class="form-control col-sm-8" placeholder="Nombre y Apellido" id="profesionalDestinoNyATR" aria-label="Profesional Estudio DestinoTR" aria-describedby="profesionalEstudioDestinoTR" />
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="profesionalDestinoTelTR">Teléfono Profesional Destino</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">+595 9</span>
              <input type="text" id="profesionalDestinoTelTR" name="profesionalDestinoTelTR" class="form-control fono-mask" placeholder="83 123 456" />
            </div>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Anterior</span> </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>
      <!-- Detalles de Alta -->
      <div id="alta-detalles" class="content">
        <div class="row g-3">
          <div class="col-sm-12">
            <label class="form-label d-block" for="altaDomicilio">Domicilio Paciente</label>
          </div>
          <div class="col-sm-4">
            <label class="form-label d-block" for="altaDistritoID">Ciudad</label>
            <select class="form-select" data-style="btn-default" id="altaDistritoID" name="altaDistritoID" aria-label="Domicilio Ciudad">
              <option selected>Seleccione Ciudad</option>
            </select>
          </div>
          <div class="col-sm-4">
            <label class="form-label d-block" for="altaBarrio">Barrio</label>
            <input type="text" class="form-control" id="altaBarrio" name="altaBarrio" placeholder="Barrio" aria-describedby="Barrio Domicilio Paciente">
          </div>

          <div class="col-sm-4">
            <label class="form-label d-block" for="altaCalle">Calles</label>
            <input type="text" class="form-control" id="altaCalle" name="altaCalle" placeholder="Calles" aria-describedby="Calle Domicilio Paciente">
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="altaRefUbicacion">Referencia Adicional Domicilio</label>
              <input type="text" class="form-control" id="altaRefUbicacion" name="altaRefUbicacion" placeholder="Ingrese detalles para llegar a ubicación" aria-describedby="Referencias a Domicilio">
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="altaUbicacionGPS">Seleccione Ubicación</label>
              <input type="text" class="form-control" id="altaUbicacionGPS" name="altaUbicacionGPS" placeholder="Marque ubicación en el mapa" aria-describedby="Ubicación GPS">
          </div>
          <div class="col-sm-12">
            <label class="form-label d-block" for="altaAdicional">Información Adicional Alta</label>
              <input type="text" class="form-control" id="altaAdicional" name="altaAdicional" placeholder="Ingrese información relevante al alta" aria-describedby="Adicional Alta">
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Anterior</span> </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>
      <!-- Resumen de Pedido -->
      <div id="confirmar-cancelar" class="content">
        <div class="row g-3">

          <!-- Resumen Pedido -->
          <div class="col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                  <div class="mb-xl-0 mb-4">
                    <div class="d-flex svg-illustration mb-3 gap-2">
                      <img src="{{asset('assets/img/branding/logo.png')}}" alt="SICX Logo" width="60" />
                      <span class="app-brand-text demo text-body fw-bold text-primary text-xl-center">{{ config('variables.templateName') }}</span>
                  </div>

                    <h6 class="pb-2">ORIGEN PACIENTE: </h6>
                    <p class="mb-1"><strong>Profesional Solicitante:</strong> <span id="resumenProfesional">N/A</span></p>
                    <p class="mb-1"><strong>Telefono:</strong> +595 9<span id="resumenProfesionalTelefono">N/A</span></p>
                    <p class="mb-1"><strong>Establecimiento:</strong> <span id="resumenEstablecimiento">N/A</span></p>
                    <p class="mb-1"><strong>Servicio:</strong> <span id="resumenServicio">N/A</span></p>
                    <p class="mb-1"><strong>Sector:</strong> <span id="resumenSector">N/A</span></p>
                    <p class="mb-0"><strong>Acompañantes:</strong> <span id="resumenAcompanantes">N/A</span></p>

                  </div>
                  <div>
                    <h4><strong>PEDIDO #3492</strong></h4>
                    <div class="mt-5 mb-2">
                      <span class="me-1"><strong>Fecha/Hora Pedido: </strong></span>
                      <span class="fw-medium" id="resumenFechaPedido">N/A</span>
                  </div>
                  <div id="resumenFHProg" class="mb-2">
                      <span class="me-1"><strong>Fecha/Hora Programada: </strong></span>
                      <span class="fw-medium" id="resumenFechaProgramada">N/A</span>
                  </div>
                    <div class="mb-2">
                      <span class="me-1"><strong>Tipo de Traslado: </strong></span>
                      <span class="fw-medium" id="resumenTipoTraslado">N/A</span>
                    </div>
                    <div class="mb-2">
                      <span class="me-1"><strong>Tiempo de Traslado: </strong></span>
                      <span class="fw-medium" id="resumenTiempoTraslado">N/A</span>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-0" />
              <!-- Detalles Paciente -->
              <div class="card-body">
                <div class="row p-sm-3 p-0">
                  <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                    <h6 class="pb-2">DETALLES DEL PACIENTE:</h6>
                    <p class="mb-1"><strong>Nombres y Apellidos: </strong><span id="resumenPacienteNombre">N/A</span></p>
                    <p class="mb-1"><strong>CI: </strong><span id="resumenPacienteCI">N/A</span></p>
                    <p class="mb-1"><strong>Sexo: </strong><span id="resumenPacienteSexo">N/A</span></p>
                    <p class="mb-1"><strong>Edad: </strong><span id="resumenPacienteEdad">N/A</span></p>
                    <p class="mb-1"><strong>Telefono de Contacto:</strong> +595 9<span id="resumenPacienteTelefono">N/A</span></p>
                    <p class="mb-0"><strong>GRAVEDAD:</strong> <span id="resumenPacienteGravedad">N/A</span></p>
                    <p class="mb-0">APP: <span id="resumenPacienteAPP">N/A</span></p>
                  </div>
                  <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                    <h6 class="pb-2">SIGNOS VITALES:</h6>
                    <table>
                      <tbody>
                        <tr>
                          <td class="pe-3"><strong>Presión Arterial:</strong></td>
                          <td id="resumenPresionArterial">N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Frecuencia Cardiaca:</strong></td>
                          <td id="resumenFrecuenciaCardiaca">N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Frecuencia Respiratoria:</strong></td>
                          <td id="resumenFrecuenciaRespiratoria">N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Saturación O2:</strong></td>
                          <td id="resumenSaturacionO2">N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Glasgow:</strong></td>
                          <td id="resumenGlasgow">N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Temperatura:</strong></td>
                          <td id="resumenTemperatura">N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Glicemia:</strong></td>
                          <td id="resumenGlicemia">N/A</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Indicaciones -->
              <hr class="my-0" />
              <div class="table-responsive">
                <table class="table border-top m-0">
                  <thead>
                    <tr>
                      <th>Farmaco / Otros</th>
                      <th>Dosis</th>
                      <th>Via</th>
                      <th>Administración</th>
                      <th>Observación</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-nowrap">DIPIRONA</td>
                      <td class="text-nowrap">02 ampolla/s</td>
                      <td>ET</td>
                      <td>En bolo, S/N y cada 6 horas</td>
                      <td>Una observacion</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap">ADRENALINA. Ampolla</td>
                      <td class="text-nowrap">01 ampolla/s</td>
                      <td>ET</td>
                      <td>En bolo, S/N.</td>
                      <td>En caso de PCR</td>
                    </tr>

                    <tr>
                      <td colspan="3" class="align-top px-4 py-5">
                        <p class="mb-2">
                          <span class="me-1 fw-medium"><strong>Complejizaciones:</strong></span>
                          <span id="resumenComplejizaciones">N/A</span></p>
                        </p>
                        <p class="mb-2">
                          <span class="me-1 fw-medium"><strong>Hidratación Parenteral:</strong></span>
                          <span id="resumenHidratacion">N/A</span></p>
                        </p>
                        <p class="mb-2">
                          <span class="me-1 fw-medium"><strong>Soporte O2:</strong></span>
                          <span id="resumenSoporteO2">N/A</span></p>
                        </p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- Para Estudios -->
              <hr class="my-0" />
              <div id="estudiosProcedimientos" class="card-body">
                <div class="row p-sm-3 p-0">

                  <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                    <h6 class="pb-2"><strong>Estudios/Procedimientos:</strong></h6>
                    <table>
                      <tbody>
                        <tr>
                          <td class="pe-3"><strong>Establecimiento:</strong></td>
                          <td>N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Profesional:</strong></td>
                          <td>N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>MC / Imp. DX / DX:</strong></td>
                          <td>N/A</td>
                        </tr>
                        <tr>
                          <td class="pe-3"><strong>Info Adicional:</strong></td>
                          <td>N/A</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /Para Estudios -->

              <!-- Para Destino -->
              <div class="card-body">
                <div class="row p-sm-3 p-0">
                  <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                    <h6 class="pb-2">Detalles Destino Paciente: </h6>
                    <p class="mb-1" span id="resumenProfesionalDestino">N/A</span></p>
                    <p class="mb-1" span id="resumenProfesionalTelefonoDestino">N/A</span></p>
                    <p class="mb-1" span id="resumenEstablecimientoDestinoName">N/A</span></p>
                    <p class="mb-1" span id="resumenServicioDestinoName">N/A</span></p>
                    <p class="mb-0" span id="resumenSectorDestinoName">N/A</span></p>
                  </div>
                </div>
              </div>
              <!-- /Para Destino -->

              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <span class="fw-medium"><strong>OBS:</strong></span>
                    <span>Usted recibirá un correo de confirmación con el resumen de su pedido. No genere pedidos adicionales para este paciente. Muchas gracias!</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Resumen Pedido -->


          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Anterior</span> </button>
            <button class="btn btn-success btn-submit btn-next">Confirmar y Enviar</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>



@endsection



