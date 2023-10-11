@extends('layouts/layoutMaster')

@section('title', 'Previsualizar - Orden de Trabajo')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-invoice.css')}}" />
@endsection

@section('page-script')
<script src="{{asset('assets/js/offcanvas-add-payment.js')}}"></script>
<script src="{{asset('assets/js/offcanvas-send-invoice.js')}}"></script>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
@endsection

@section('content')

<div class="row invoice-preview">
  <!-- Resumen Pedido -->
  <div class="col-xl-12 col-md-8 col-12 mb-md-0 mb-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
          <div class="mb-xl-0 mb-4">
            <div class="d-flex svg-illustration mb-3 gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>40,"withbg"=>'var(--bs-primary)'])</span>
              <span class="app-brand-text demo text-body fw-bold">{{ config('variables.templateName') }}</span>
            </div>
            <h6 class="pb-2">Detalles Origen Paciente: </h6>
            <p class="mb-1">Profesional Solicitante: <span id="resumenProfesional">N/A</span></p>
            <p class="mb-1">Telefono: <span id="resumenProfesionalTelefono">N/A</span></p>
            <p class="mb-1">Establecimiento: <span id="resumenEstablecimiento">N/A</span></p>
            <p class="mb-1">Servicio: <span id="resumenServicio">N/A</span></p>
            <p class="mb-1">Sector: <span id="resumenSector">N/A</span></p>
            <p class="mb-0">Acompañantes: <span id="resumenAcompanantes">N/A</span></p>
          </div>
          <div>
            <h4>PEDIDO #3492</h4>
            <div class="mb-2">
              <span class="me-1">Fecha/Hora Pedido: </span>
              <span class="fw-medium" id="resumenFechaPedido">N/A</span>
          </div>
          <div class="mb-2">
              <span class="me-1">Fecha/Hora Programada: </span>
              <span class="fw-medium" id="resumenFechaProgramada">N/A</span>
          </div>
            <div class="mb-2">
              <span class="me-1">Tipo de Traslado: </span>
              <span class="fw-medium" id="resumenTipoTraslado">N/A</span>
            </div>
            <div class="mb-2">
              <span class="me-1">Tiempo de Traslado: </span>
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
            <p class="mb-1">Nombres y Apellidos: <span id="resumenPacienteNombre">N/A</span></p>
            <p class="mb-1">CI: <span id="resumenPacienteCI">N/A</span></p>
            <p class="mb-1">Sexo: <span id="resumenPacienteSexo">N/A</span></p>
            <p class="mb-1">Edad: <span id="resumenPacienteEdad">N/A</span></p>
            <p class="mb-0">Telefono de Contacto: <span id="resumenPacienteTelefono">N/A</span></p>
            <p class="mb-0">GRAVEDAD: <span id="resumenPacienteGravedad">N/A</span></p>
            <p class="mb-0">APP: <span id="resumenPacienteAPP">N/A</span></p>
          </div>
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="pb-2">SIGNOS VITALES:</h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-3">Presión Arterial:</td>
                  <td id="resumenPresionArterial">N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Frecuencia Cardiaca:</td>
                  <td id="resumenFrecuenciaCardiaca">N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Frecuencia Respiratoria:</td>
                  <td id="resumenFrecuenciaRespiratoria">N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Saturación O2:</td>
                  <td id="resumenSaturacionO2">N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Glasgow:</td>
                  <td id="resumenGlasgow">N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Temperatura:</td>
                  <td id="resumenTemperatura">N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Glicemia:</td>
                  <td id="resumenGlicemia">N/A</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Indicaciones -->
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
                  <span class="me-1 fw-medium">Complejizaciones:</span>
                  <span id="resumenComplejizaciones">N/A</span></p>
                </p>
                <p class="mb-2">
                  <span class="me-1 fw-medium">Hidratación Parenteral:</span>
                  <span id="resumenHidratacion">N/A</span></p>
                </p>
                <p class="mb-2">
                  <span class="me-1 fw-medium">Soporte O2:</span>
                  <span id="resumenSoporteO2">N/A</span></p>
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Para Estudios -->
      <hr class="my-0" />
      <div class="card-body">
        <div class="row p-sm-3 p-0">

          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="pb-2">Estudios/Procedimientos:</h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-3">Establecimiento:</td>
                  <td>N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Profesional:</td>
                  <td>N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">MC / Imp. DX / DX:</td>
                  <td>N/A</td>
                </tr>
                <tr>
                  <td class="pe-3">Info Adicional:</td>
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
            <p class="mb-1" span id="resumenEstablecimientoDestino">N/A</span></p>
            <p class="mb-1" span id="resumenServicioDestino">N/A</span></p>
            <p class="mb-0" span id="resumenSectorDestino">N/A</span></p>
          </div>
        </div>
      </div>
      <!-- /Para Destino -->

      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <span class="fw-medium">Note:</span>
            <span>Usted recibirá un correo de confirmación con el resumen de su pedido. No genere pedidos adicionales para este paciente. Muchas gracias!</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Resumen Pedido -->

  <!-- Invoice Actions -->
  <div class="col-xl-3 col-md-4 col-12 invoice-actions">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-paper-plane bx-xs me-1"></i>Send Invoice</span>
        </button>
        <button class="btn btn-label-secondary d-grid w-100 mb-3">
          Download
        </button>
        <a class="btn btn-label-secondary d-grid w-100 mb-3" target="_blank" href="{{url('app/invoice/print')}}">
          Print
        </a>
        <a href="{{url('app/invoice/edit')}}" class="btn btn-label-secondary d-grid w-100 mb-3">
          Edit Invoice
        </a>
        <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-dollar bx-xs me-1"></i>Add Payment</span>
        </button>
      </div>
    </div>
  </div>
  <!-- /Invoice Actions -->
</div>

<!-- Offcanvas -->
@include('_partials/_offcanvas/offcanvas-send-invoice')
@include('_partials/_offcanvas/offcanvas-add-payment')
<!-- /Offcanvas -->
@endsection
