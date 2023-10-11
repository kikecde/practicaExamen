@extends('layouts/layoutMaster')

@section('title', 'User View - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-user-view.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/modal-edit-user.js')}}"></script>
<script src="{{asset('assets/js/app-user-view.js')}}"></script>
<script src="{{asset('assets/js/app-user-view-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Movil / Ver /</span> Perfil
</h4>
<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            <img class="img-fluid rounded my-4" src="{{asset('assets/img/avatars/10.png')}}" height="110" width="110" alt="User avatar" />
            <div class="user-info text-center">
              <h4 class="mb-2">XRSB20</h4>
              <span class="badge bg-label-secondary">SVA</span>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
          <div class="d-flex align-items-start me-4 mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
            <div>
              <h5 class="mb-0">1.23k</h5>
              <span>Viajes Realizados</span>
            </div>
          </div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
            <div>
              <h5 class="mb-0">568</h5>
              <span>Kilometros Recorridos</span>
            </div>
          </div>
        </div>
        <div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
            <div>
              <h5 class="mb-0">MERCEDES BENZ</h5>
              <span>SPRINTER</span>
            </div>
          </div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
            <div>
              <h5 class="mb-0">STATUS</h5>
              <span class="badge bg-label-success">Activo</span>
            </div>
          </div>
        </div>
        <h5 class="pb-2 border-bottom mb-4">Detalles</h5>
        <div class="info-container">
          <ul class="list-unstyled">
            <li class="mb-3">
              <span class="fw-medium me-2">Tipo Movil:</span>
              <span>Ambulancia</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Tipo Ambulancia:</span>
              <span>Soporte Vital Básico</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Base Operativa:</span>
              <span>SEME XRS</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Motor:</span>
              <span>2000</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Chapa:</span>
              <span>IJQ907</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">RASP:</span>
              <span>C-XXXXXXX</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Chasis:</span>
              <span>76757556d</span>
            </li>

          </ul>
          <div class="d-flex justify-content-center pt-3">
            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editMovil" data-bs-toggle="modal">Editar</a>
            <a href="javascript:;" class="btn btn-label-danger suspend-movil">Suspender</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /Movil Card -->
    <!-- Combustible Card -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <span class="badge bg-label-primary">Diesel</span>
          <div class="d-flex justify-content-center">
            <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">PROMEDIO</sup>
            <h1 class="display-5 mb-0 text-primary">14</h1>
            <sub class="fs-6 pricing-duration mt-auto mb-3">l/100</sub>
          </div>
        </div>
        <ul class="ps-3 g-2 my-4">
          <li class="mb-2">SALDO ACTUAL</li>
          <li class="mb-2">1.435.343 Gs</li>
          <li>Actualizado: 11/09/2023 10:05:00</li>
        </ul>
        <div class="d-flex justify-content-between align-items-center mb-1">
          <span>Actual</span>
          <span>65% Capacidad</span>
        </div>
        <div class="progress mb-1" style="height: 8px;">
          <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span>186 kilometros autonomía (aproximada)</span>
        <div class="d-grid w-100 mt-4 pt-2">
          <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Registrar Carga</button>
        </div>
      </div>
    </div>
    <!-- /Plan Card -->
  </div>
  <!--/ Movil Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Pills -->
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bxs-ambulance me-1"></i>Info</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/security')}}"><i class="bx bx-trip me-1"></i>Actividad</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/billing')}}"><i class="bx bx-gas-pump me-1"></i>Carga y Facturación</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/notifications')}}"><i class="bx bx-wrench me-1"></i>Mecánica</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/connections')}}"><i class="bx bx-category-alt me-1"></i>Componentes</a></li>
    </ul>
    <!--/ User Pills -->

    <!-- Project table -->
    <div class="card mb-4">
      <h5 class="card-header">Viajes Realizados</h5>
      <div class="table-responsive mb-3">
        <table class="table datatable-project border-top">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Despacho</th>
              <th class="text-nowrap">Distancia</th>
              <th>Progreso</th>
              <th>Tiempo</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- /Project table -->

    <!-- Activity Timeline -->
    <div class="card mb-4">
      <h5 class="card-header">Timeline de Movil</h5>
      <div class="card-body">
        <ul class="timeline">
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-primary"></span></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">2 Ordenes de trabajo emitidas</h6>
                <small class="text-muted">12 min ago</small>
              </div>
              <p class="mb-2">01 Viaje larga distancia + 01 Genérico Local</p>
              <div class="d-flex">
                <a href="javascript:void(0)" class="me-3">
                  <img src="{{asset('assets/img/icons/misc/pdf.png')}}" alt="PDF image" width="15" class="me-2">
                  <span class="fw-medium text-body">OT00464.pdf</span>
                </a>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-warning"></span></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Despacho Emitido</h6>
                <small class="text-muted">45 min atras</small>
              </div>
              <p class="mb-2">OT SEPT00464 @10:15am</p>
              <div class="d-flex flex-wrap">
                <div class="avatar me-3">
                  <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <h6 class="mb-0">ENRIQUE MALDONADO (VIA DESPACHO)</h6>
                  <span class="text-muted">COORDINADOR de {{ config('variables.creatorName') }}</span>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-info"></span></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Ingreso tripulación</h6>
                <small class="text-muted">1 Dia Atras</small>
              </div>
              <p class="mb-2">1 Conductor + 2 Paramédicos</p>
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
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
            <div class="timeline-event">
              <div class="timeline-header mb-1">
                <h6 class="mb-0">Mantenimiento Agendado</h6>
                <small class="text-muted">5 dias atras</small>
              </div>
              <p class="mb-0">Miercoles 20/09/2023. CONDOR SACI. Encargado: Juan Perez</p>
            </div>
          </li>
          <li class="timeline-end-indicator">
            <i class="bx bx-check-circle"></i>
          </li>
        </ul>
      </div>
    </div>
    <!-- /Activity Timeline -->

    <!-- Invoice table -->
    <div class="card mb-4">
      <div class="table-responsive mb-3">
        <table class="table datatable-invoice border-top">
          <thead>
            <tr>
              <th></th>
              <th>ID</th>
              <th><i class='bx bx-trending-up'></i></th>
              <th>Monto</th>
              <th>Fecha de Emisión</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- /Invoice table -->
  </div>
  <!--/ User Content -->
</div>

<!-- Modal -->
@include('_partials/_modals/modal-edit-movil')
@include('_partials/_modals/modal-upgrade-plan')
<!-- /Modal -->
@endsection
