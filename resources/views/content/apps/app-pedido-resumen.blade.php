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
  <!-- Invoice -->
  <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
          <div class="mb-xl-0 mb-4">
            <div class="d-flex svg-illustration mb-3 gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
              <span class="app-brand-text demo text-body fw-bold">{{ config('variables.templateName') }}</span>
            </div>
            <p class="mb-1">Profesional Solicitante:</p>
            <p class="mb-1">Telefono:</p>
            <p class="mb-1">Establecimiento:</p>
            <p class="mb-1">Servicio:</p>
            <p class="mb-0">Sector:</p>
          </div>
          <div>
            <h4>Pedido #3492</h4>
            <div class="mb-2">
              <span class="me-1">Fecha/Hora Pedido:</span>
              <span class="fw-medium">25/08/2020</span>
            </div>
            <div>
              <span class="me-1">Fecha/Hora Programada:</span>
              <span class="fw-medium">29/08/2020</span>
            </div>
            <div>
              <span class="me-1">Tipo de Traslado:</span>
              <span class="fw-medium">Referencia/Contrarreferencia</span>
            </div>
            <div>
              <span class="me-1">Tiempo de Traslado:</span>
              <span class="fw-medium">Urgente</span>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <div class="row p-sm-3 p-0">
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="pb-2">Destino del Paciente:</h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-3">Establecimiento:</td>
                  <td>$12,110.55</td>
                </tr>
                <tr>
                  <td class="pe-3">Servicio:</td>
                  <td>American Bank</td>
                </tr>
                <tr>
                  <td class="pe-3">Sector:</td>
                  <td>United States</td>
                </tr>
                <tr>
                  <td class="pe-3">Profesional:</td>
                  <td>ETD95476213874685</td>
                </tr>
                <tr>
                  <td class="pe-3">Teléfono Profesional:</td>
                  <td>BR91905</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="pb-2">Estudios Solicitados:</h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-3">Establecimiento:</td>
                  <td>$12,110.55</td>
                </tr>
                <tr>
                  <td class="pe-3">Estudio:</td>
                  <td>American Bank</td>
                </tr>
                <tr>
                  <td class="pe-3">Sector:</td>
                  <td>United States</td>
                </tr>
                <tr>
                  <td class="pe-3">Profesional:</td>
                  <td>ETD95476213874685</td>
                </tr>
                <tr>
                  <td class="pe-3">Teléfono Profesional:</td>
                  <td>BR91905</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table border-top m-0">
          <thead>
            <tr>
              <th>Establecimiento</th>
              <th>Estudio/Procedimiento</th>
              <th>Especificacion 01</th>
              <th>Especificacion 02</th>
              <th>Profesional</th>
              <th>Especificacion 04</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-nowrap">Vuexy Admin Template</td>
              <td class="text-nowrap">HTML Admin Template</td>
              <td>$32</td>
              <td>1</td>
              <td>$32.00</td>
              <td>1</td>
            </tr>

            <tr>
              <td colspan="3" class="align-top px-4 py-5">
                <p class="mb-2">
                  <span class="me-1 fw-medium">Diagnóstico/s:</span>
                  <span>NAC</span>
                </p>
                <p class="mb-2">
                  <span class="me-1 fw-medium">Gravedad:</span>
                  <span>Inestable Leve</span>
                </p>
                <span>Thanks for your business</span>
              </td>
              <td class="text-end px-4 py-5">
                <p class="mb-2">Presión Arterial:</p>
                <p class="mb-2">Frecuencia Cardíaca:</p>
                <p class="mb-2">Frecuencia Respiratoria:</p>
                <p class="mb-2">SatO2:</p>
                <p class="mb-2">Glasgow:</p>
                <p class="mb-2">Temperatura:</p>
                <p class="mb-0">Glicemia:</p>

              </td>
              <td class="px-4 py-5">
                <p class="fw-medium mb-2">$154.25</p>
                <p class="fw-medium mb-2">$00.00</p>
                <p class="fw-medium mb-2">$50.00</p>
                <p class="fw-medium mb-2">$00.00</p>
                <p class="fw-medium mb-2">$50.00</p>
                <p class="fw-medium mb-2">$00.00</p>
                <p class="fw-medium mb-0">$204.25</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <span class="fw-medium">Complejizaciones:</span>
            <span>Paciente blablabalbalaba</span>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <span class="fw-medium">Información Adicional:</span>
            <span>Paciente blablabalbalaba</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Invoice -->

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
