@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Funciones / Cargos - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-access-roles.js')}}"></script>
<script src="{{asset('assets/js/modal-add-role.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-2">Lista de Funciones y Cargos</h4>

<p>Seleccione el alcance de la lista de funciones y cargos. Filtre por Establecimiento <br>por Area, o por ambos. </p>




  <!-- Cargos cards -->
  <div class="row g-4">
    <div class="row g-4">
      <div class="col-3 mb-3">
        <label class="form-label" for="selectEstablecimiento">Estructura</label>
        <select class="form-select" id="selectEstablecimiento" name="selectEstablecimiento">
          <option disabled value="">Seleccionar Estructura</option>
          <option value="120">Región (DÉCIMA)</option>
          <option value="1">HR CIUDAD DEL ESTE</option>
          <option value="2">HD HERNANDARIAS</option>
          <option value="3">HD PRESIDENTE FRANCO</option>
          <option value="4">HD MINGA GUAZU</option>
          <option value="5">HD SANTA RITA</option>
        </select>
      </div>
      <div class="col-3 mb-3">
        <label class="form-label" for="selectTipoEstablecimiento">Nivel Establecimiento</label>
        <select class="form-select" id="selectTipoEstablecimiento" name="selectTipoEstablecimiento">
          <option disabled value="">Seleccionar Nivel</option>
          <option value="120">Todos</option>
          <option value="1">Nivel 1</option>
          <option value="2">Nivel 2</option>
          <option value="3">Nivel 3</option>
          <option value="4">Nivel 4</option>
          <option value="5">Nivel 5</option>
        </select>
      </div>
      <div class="col-3">
        <label class="form-label" for="selectAreaTipo">Area</label>
        <select class="form-select" id="selectAreaTipo" name="selectAreaTipo">
          <option disabled value="">Seleccionar Area</option>
          <option value="1">Todo</option>
          <option value="2">Cargos del Area Médica</option>
          <option value="3">Cargos del Personal de Blanco</option>
          <option value="4">Cargos Administrativos</option>
        </select>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Cargos Generales -->
    <div class="row g-4">
      <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <h6 class="fw-normal">Total 4 funcionarios</h6>
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/12.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                </li>
              </ul>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <div class="role-heading">
                <h4 class="mb-1">Dirección Ejecutiva</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
              </div>
              <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <h6 class="fw-normal">Total 7 funcionarios</h6>
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                </li>
              </ul>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <div class="role-heading">
                <h4 class="mb-1">Dirección de Area</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
              </div>
              <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Cargos Generales -->

    <!-- Cargos De Blanco -->
    <div class="row g-4">

      <!-- Cargos Medicos -->
      <div class="row g-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 3 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/11.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Dirección de Servicio Médico</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 6 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Dirección de Departamento Médico</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 7 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Coordinación de Sector Médico</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 7 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Jefe de Guardia</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 5 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rishi Swaat" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/12.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/13.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Médico de Turno</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 2 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/13.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/8.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Medico Residente</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Cargos Medicos -->

      <!-- Cargos Enfermeria/Obstetricia -->
      <div class="row g-4" style="display: none;">
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 3 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/11.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Jefatura de Enfermería</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 6 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Jefe de Servicio Enfermería</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 7 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Referente de Enfermería</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 7 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Supervisor de Enfermería</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 7 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Enfermero de Guardia</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 5 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rishi Swaat" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/12.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/13.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Jefe de Obstetricia</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 2 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/13.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/8.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Supervisor de Guardia Obstetricia</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">Total 2 funcionarios</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/13.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/8.png')}}" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                    <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h4 class="mb-1">Obstetra de Turno</h4>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                </div>
                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Cargos Enfermeria/Obstetricia -->



    </div>
    <!--/ Cargos De Blanco -->





    <!-- Cargos Administrativos -->
    <div class="row g-4" style="display: none;">
      <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <h6 class="fw-normal">Total 3 funcionarios</h6>
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/9.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/11.png')}}" alt="Avatar">
                </li>
              </ul>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <div class="role-heading">
                <h4 class="mb-1">Dirección de Departamento</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
              </div>
              <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <h6 class="fw-normal">Total 6 funcionarios</h6>
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/15.png')}}" alt="Avatar">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                  <img class="rounded-circle" src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar">
                </li>
              </ul>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <div class="role-heading">
                <h4 class="mb-1">Dirección de Sub Departamento</h4>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
              </div>
              <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Cargos Administrativos -->

    <div class="col-xl-3 col-lg-6 col-md-6">
      <div class="card h-100">
        <div class="row h-100">
          <div class="col-sm-5">
            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
              <img src="{{asset('assets/img/illustrations/sitting-girl-with-laptop-'.$configData['style'].'.png')}}" class="img-fluid" alt="Image" width="120" data-app-light-img="illustrations/sitting-girl-with-laptop-light.png" data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.png">
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-3 text-nowrap add-new-role">Add New Role</button>
              <p class="mb-0">Agregar Cargo</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <!-- Role Table -->
      <div class="card">
        <div class="card-datatable table-responsive">
          <table class="datatables-users table border-top">
            <thead>
              <tr>
                <th></th>
                <th>User</th>
                <th>Role</th>
                <th>Plan</th>
                <th>Billing</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!--/ Role Table -->
    </div>


  </div>
<!--/ Role cards -->

<!-- Add Role Modal -->
@include('_partials/_modals/modal-add-role')
<!-- / Add Role Modal -->
@endsection
