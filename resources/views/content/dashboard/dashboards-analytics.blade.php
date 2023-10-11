@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard - Información')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Buen día, Dr. Enrique! 🎉</h5>
            <p class="mb-4">Los reportes indican un aumento del <span class="fw-medium">12%</span> en traslados pediatricos. Vea mas detalles en los reportes del día.</p>

            <a href="javascript:;" class="btn btn-sm btn-label-primary">Ver Reportes AI</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-'.$configData['style'].'.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0">
            <span class="d-block fw-semibold">Arbovirosis</span>
            <small class="text-muted">Confirmados - Abril</small>
            <h3 class="card-title mb-1">1375</h3>
          </div>
          <div id="orderChart" class="mb-3"></div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/ingresos warning.png')}}" alt="Ingresos" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                  <a class="dropdown-item" href="javascript:void(0);">Ocultar</a>
                </div>
              </div>
            </div>
            <span class="d-block fw-semibold">Ingresos</span>
            <small class="text-muted">(24 hs)</small>

            <h3 class="card-title text-nowrap mb-1">112</h3>
            <small class="text-danger fw-semibold"><i class='bx bx-up-arrow-alt'></i> +21.72%</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Total Revenue -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-1">Disponibilidad Camas</h5>
          <small class="text-muted m-4 me-2">HDH</small>

          <div id="totalRevenueChart" class="px-2"></div>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-center">
              <div class="dropdown">
                <button class="btn btn-sm btn-label-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  HDH
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                  <a class="dropdown-item" href="javascript:void(0);">HRCDE</a>
                  <a class="dropdown-item" href="javascript:void(0);">HDPF</a>
                  <a class="dropdown-item" href="javascript:void(0);">HDMG</a>
                  <a class="dropdown-item" href="javascript:void(0);">HDSR</a>
                </div>
              </div>
            </div>
          </div>
          <div id="growthChart"></div>
          <div class="text-center fw-semibold pt-3 mb-2">3 Disponibles</div>

          <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-primary p-2"><i class="bx bx-hotel"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>Ocupadas</small>
                <h6 class="mb-0">86</h6>
              </div>
            </div>
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-info p-2"><i class="bx bx-bed"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>Disponibles</small>
                <h6 class="mb-0">17</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/red-code danger.png')}}" alt="Red Code" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                  <a class="dropdown-item" href="javascript:void(0);">Ocultar</a>
                </div>
              </div>
            </div>
            <span class="d-block mb-1">Códigos Rojos</span>
            <small class="text-muted">(24 hs)</small>
            <h3 class="card-title text-nowrap mb-2">3</h3>
            <small class="text-success fw-semibold"><i class='bx bx-down-arrow-alt'></i> -14.82%</small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body pb-2">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/obit danger.png')}}" alt="Obitos" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                  <a class="dropdown-item" href="javascript:void(0);">Ocultar</a>
                </div>
              </div>
            </div>

            <span class="d-block fw-semibold mb-1">Óbitos</span>
            <small class="text-muted">SE 13</small>
            <h3 class="card-title mb-1">11</h3>
            <div id="revenueChart"></div>
          </div>
        </div>
      </div>
      <!-- </div>
    <div class="row"> -->
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Consultas</h5>
                  <span class="badge bg-label-warning rounded-pill">Acumulado Abril</span>
                </div>
                <div class="mt-sm-auto">
                  <small class="text-warning text-nowrap fw-semibold"><i class='bx bx-chevron-up'></i> 28.2%</small>
                  <h3 class="mb-0">1364</h3>
                </div>
              </div>
              <div id="profileReportChart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Combustibles ⛽️</h5>
          <small class="text-muted">35.231.543 Gs (Acumulado Año 2023)</small>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            <a class="dropdown-item" href="javascript:void(0);">Seleccionar todo</a>
            <a class="dropdown-item" href="javascript:void(0);">Actualizar</a>
            <a class="dropdown-item" href="javascript:void(0);">Compartir</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">825</h2>
            <span>Total Septiembre</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-mobile-alt'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">XRSB10</h6>
                <small class="text-muted">% Meta Mes: 88%</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">124</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class='bx bx-closet'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">XRSB11</h6>
                <small class="text-muted">% Meta Mes: 37%</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">218</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class='bx bx-home-alt'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">XRSB12</h6>
                <small class="text-muted">% Meta Mes: 58%</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">246</small>
              </div>
            </div>
          </li>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-secondary"><i class='bx bx-football'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">XRSB20</h6>
                <small class="text-muted">% Meta Mes: 77%</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">189</small>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Expense Overview -->
  <div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <div class="card-title mb-3">
          <h5 class="m-0 me-2">SEME XRS   🚑💨💨</h5>
          <small class="text-muted mb-3">Traslados últimas 4 semanas</small>
        </div>
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">Locales</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Regionales</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Nacionales</button>
          </li>
        </ul>
      </div>
      <div class="card-body px-0">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div class="d-flex p-4 pt-3">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/rocket.png')}}" alt="User">
              </div>
              <div>
                <small class="text-muted d-block">Distancia total 7 dias</small>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1">859.10</h6>
                  <small class="text-danger fw-semibold">
                    <i class='bx bx-chevron-up'></i>
                    32.9%
                  </small>
                </div>
              </div>
            </div>
            <div id="incomeChart"></div>
            <div class="d-flex justify-content-center pt-4 gap-2">
              <div class="flex-shrink-0">
                <div id="expensesOfWeek"></div>
              </div>
              <div>
                <p class="mb-n1 mt-1">Pedidos atendidos</p>
                <small class="text-muted">4 mas que semana anterior</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Expense Overview -->

  <!-- Transactions -->
  <div class="col-md-6 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Disponibilidad Camas</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="text-center">
          <div class="dropdown">
            <button class="btn btn-label-primary dropdown-toggle mb-4" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Clínica Médica
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
              <a class="dropdown-item" href="javascript:void(0);">Cirugia</a>
              <a class="dropdown-item" href="javascript:void(0);">Pediatría</a>
              <a class="dropdown-item" href="javascript:void(0);">Ginecobstetricia</a>
              <a class="dropdown-item" href="javascript:void(0);">UTI-A</a>
            </div>
          </div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Actualiza: 2 hs atras</small>
                <h6 class="mb-0">HDPF</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">11</h6> <span class="text-muted">Camas</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Actualiza: 17 hs atras</small>
                <h6 class="mb-0">HDSR</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">9</h6> <span class="text-muted">Camas</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/chart.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Actualiza: 2 hs atras</small>
                <h6 class="mb-0">HDMG</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">8</h6> <span class="text-muted">Camas</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Actualiza: 11 hs atras</small>
                <h6 class="mb-0">HDH</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">6</h6> <span class="text-muted">Camas</span>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Actualiza: 1 hs atras</small>
                <h6 class="mb-0">HRCDE</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">4</h6> <span class="text-muted">Camas</span>
              </div>
            </div>
          </li>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/cc-warning.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="text-muted d-block mb-1">Actualiza: 6 hs atras</small>
                <h6 class="mb-0">CSITK</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">1</h6> <span class="text-muted">Camas</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Transactions -->
  <!-- Activity Timeline -->
  <div class="col-md-12 col-lg-6 order-4 order-lg-3 ">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Agenda Sanitaria</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="timelineWapper" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Activity Timeline -->
        <ul class="timeline">
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Reunión APS</h6>
                <small class="text-muted">En 2 días</small>
              </div>
              <p class="mb-2">Director APS, Jefa de Estadísticas</p>
              <div class="d-flex">
                <a href="javascript:void(0)" class="d-flex align-items-center me-3">
                  <img src="{{asset('assets/img/icons/misc/pdf.png')}}" alt="PDF image" width="23" class="me-2">
                  <h6 class="mb-0">Circular333.pdf</h6>
                </a>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Reunión Mensual Gobernación</h6>
                <small class="text-muted">En 6 días</small>
              </div>
              <p class="mb-2">Presentación Proyecto Salud @10:15am</p>
              <div class="d-flex flex-wrap">
                <div class="avatar me-3">
                  <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <h6 class="mb-0">Fulano de Tal (Secretario Salud Gobernación)</h6>
                  <span>Sala de Reuniones</span>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-info"></span>
            <div class="timeline-event pb-0">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Creación de Plataforma SCIX</h6>
                <small class="text-muted">En 10 días</small>
              </div>
              <p class="mb-2">Equipo de diseño</p>
              <div class="d-flex align-items-center avatar-group">
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                  <img src="{{asset('assets/img/avatars/12.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Jackson">
                  <img src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristine Gill">
                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nelson Wilson">
                  <img src="{{asset('assets/img/avatars/14.png')}}" alt="Avatar" class="rounded-circle">
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-end-indicator">
            <i class="bx bx-check-circle"></i>
          </li>
        </ul>
        <!-- /Activity Timeline -->
      </div>
    </div>
  </div>
  <!--/ Activity Timeline -->
  <!-- pill table -->
  <div class="col-md-6 order-3 order-lg-4 mb-4 mb-lg-0">
    <div class="card text-center">
      <div class="card-header py-3">
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser" aria-selected="true">Programas</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-os" aria-controls="navs-pills-os" aria-selected="false">Nutrición</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-country" aria-controls="navs-pills-country" aria-selected="false">Odontología</button>
          </li>
        </ul>
      </div>
      <div class="tab-content pt-0">
        <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
          <div class="table-responsive text-start">
            <table class="table table-borderless text-nowrap">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Programa</th>
                  <th>Consultas</th>
                  <th class="w-50">En porcentaje</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Chrome" height="24" class="me-2">
                      <span>Crónicas Evitables</span>
                    </div>
                  </td>
                  <td>892</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 84.75%" aria-valuenow="84.75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">84.75%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Safari" height="24" class="me-2">
                      <span>Primera Infancia</span>
                    </div>
                  </td>
                  <td>729</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72.43%" aria-valuenow="72.43" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">72.43%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Firefox" height="24" class="me-2">
                      <span>Prevención Obesidad</span>
                    </div>
                  </td>
                  <td>611</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 67.37%" aria-valuenow="67.37" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">67.37%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Edge" height="24" class="me-2">
                      <span>Lucha contra Cancer</span>
                    </div>
                  </td>
                  <td>508</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 60.12%" aria-valuenow="60.12" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">60.12%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Opera" height="24" class="me-2">
                      <span>Desnutrición Infantil</span>
                    </div>
                  </td>
                  <td>393</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 51.94%" aria-valuenow="51.94" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">51.94%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Brave" height="24" class="me-2">
                      <span>Prenatal temprano</span>
                    </div>
                  </td>
                  <td>319</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 39.94%" aria-valuenow="39.94" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">39.94%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Vivaldi" height="24" class="me-2">
                      <span>PRONASIDA</span>
                    </div>
                  </td>
                  <td>129</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 28.43%" aria-valuenow="28.43" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">18.43%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="UC Browser" height="24" class="me-2">
                      <span>Embarazo juvenil</span>
                    </div>
                  </td>
                  <td>32</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20.14%" aria-valuenow="20.14" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">20.14%</small>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-os" role="tabpanel">
          <div class="table-responsive text-start">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th>No</th>
                  <th>System</th>
                  <th>Visits</th>
                  <th class="w-50">Data In Percentage</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/windows.png')}}" alt="Windows" height="24" class="me-2">
                      <span>Windows</span>
                    </div>
                  </td>
                  <td>875.24k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 71.50%" aria-valuenow="71.50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">71.50%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/mac.png')}}" alt="Mac" height="24" class="me-2">
                      <span>Mac</span>
                    </div>
                  </td>
                  <td>89.68k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66.67%" aria-valuenow="66.67" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">66.67%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/ubuntu.png')}}" alt="Ubuntu" height="24" class="me-2">
                      <span>Ubuntu</span>
                    </div>
                  </td>
                  <td>37.68k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 62.82%" aria-valuenow="62.82" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">62.82%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/chrome.png')}}" alt="Chrome" height="24" class="me-2">
                      <span>Chrome</span>
                    </div>
                  </td>
                  <td>35.34k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 56.25%" aria-valuenow="56.25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">56.25%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/cent.png')}}" alt="Cent" height="24" class="me-2">
                      <span>Cent</span>
                    </div>
                  </td>
                  <td>32.25k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 42.76%" aria-valuenow="42.76" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">42.76%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/linux.png')}}" alt="Linux" height="24" class="me-2">
                      <span>Linux</span>
                    </div>
                  </td>
                  <td>22.15k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 37.77%" aria-valuenow="37.77" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">37.77%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/fedora.png')}}" alt="Fedora" height="24" class="me-2">
                      <span>Fedora</span>
                    </div>
                  </td>
                  <td>1.13k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 29.16%" aria-valuenow="29.16" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">29.16%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/img/icons/brands/vivaldi-os.png')}}" alt="Vivaldi" height="24" class="me-2">
                      <span>Vivaldi</span>
                    </div>
                  </td>
                  <td>1.09k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 26.26%" aria-valuenow="26.26" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">26.26%</small>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-country" role="tabpanel">
          <div class="table-responsive text-start">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Country</th>
                  <th>Visits</th>
                  <th class="w-50">Data In Percentage</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/us.svg')}}" alt="USA" height="24" class="me-2">
                      <span>USA</span>
                    </div>
                  </td>
                  <td>87.24k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 89.12%" aria-valuenow="89.12" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">89.12%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/br.svg')}}" alt="Brazil" height="24" class="me-2">
                      <span>Brazil</span>
                    </div>
                  </td>
                  <td>62.68k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 78.23%" aria-valuenow="78.23" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">78.23%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/in.svg')}}" alt="India" height="24" class="me-2">
                      <span>India</span>
                    </div>
                  </td>
                  <td>52.58k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 69.82%" aria-valuenow="69.82" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">69.82%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/au.svg')}}" alt="Australia" height="24" class="me-2">
                      <span>Australia</span>
                    </div>
                  </td>
                  <td>44.13k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 59.90%" aria-valuenow="59.90" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">59.90%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/de.svg')}}" alt="Germany" height="24" class="me-2">
                      <span>Germany</span>
                    </div>
                  </td>
                  <td>32.21k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 57.11%" aria-valuenow="57.11" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">57.11%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/fr.svg')}}" alt="France" height="24" class="me-2">
                      <span>France</span>
                    </div>
                  </td>
                  <td>37.87k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 41.23%" aria-valuenow="41.23" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">41.23%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/pt.svg')}}" alt="Portugal" height="24" class="me-2">
                      <span>Portugal</span>
                    </div>
                  </td>
                  <td>20.29k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 37.11%" aria-valuenow="37.11" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">37.11%</small>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/svg/flags/cn.svg')}}" alt="China" height="24" class="me-2">
                      <span>China</span>
                    </div>
                  </td>
                  <td>12.21k</td>
                  <td>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                      <div class="progress w-100" style="height:10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 17.61%" aria-valuenow="17.61" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="fw-semibold">17.61%</small>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ pill table -->
</div>
@endsection
