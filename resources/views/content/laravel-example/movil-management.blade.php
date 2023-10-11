@extends('layouts/layoutMaster')

@section('title', 'Gestión de Moviles - APP')

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
<script src="{{asset('js/laravel-movil-management.js')}}"></script>
@endsection

@section('content')

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Ambulancias</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$totalMovil}}</h3>
              <small class="text-success">(100%)</small>
            </div>
            <small>Total Monitoreadas</small>
          </div>
          <span class="badge bg-label-primary rounded p-2">
            <i class="bx bxs-ambulance bx-sm"></i>
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
            <span>Operativas</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$operativoTotal}}</h3>
              <small class="text-success">{{$porcentajeOperativo}}%</small>
            </div>
            <small>Actualizado: {{$operativoLastUpdate}} </small>
          </div>
          <span class="badge bg-label-success rounded p-2">
            <i class="bx bxs-ambulance bx-sm"></i>
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
            <span>Inoperativas</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$inoperativo}}</h3>
              <small class="text-danger">{{$porcentajeInoperativo}}%</small>
            </div>
            <small>Actualizado: {{$noOperativoLastUpdate}} </small>
          </div>
          <span class="badge bg-label-danger rounded p-2">
            <i class="bx bxs-ambulance bx-sm"></i>
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
            <span>Activas</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$movilesActivos}}</h3>
              <small class="text-danger">{{$porcentajeActivo}}%</small>
            </div>
            <small>Tiempo Real</small>
          </div>
          <span class="badge bg-label-warning rounded p-2">
            <i class="bx bx-trip bx-sm"></i>
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
            <span>Standby</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$movilesStandBy}}</h3>
              <small class="text-success">{{$porcentajeStandby}}%</small>
            </div>
            <small>Tiempo Real</small>
          </div>
          <span class="badge bg-label-warning rounded p-2">
            <i class="bx bx-coffee bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Moviles List Table -->
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Filtros de Búsqueda</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-moviles table border-top">
      <thead>
        <tr>
          <th></th>
          <th>Nro</th>
          <th>Movil</th>
          <th>Tipo</th>
          <th>Base</th>
          <th>Saldo</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new movil -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddMovil" aria-labelledby="offcanvasAddMovilLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddMovilLabel" class="offcanvas-title">Agregar Movil</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-movil pt-0" id="addNewMovilForm">
        <input type="hidden" name="id" id="movil_id">
        <div class="mb-3">
          <label class="form-label" for="identidadMovil">Identidad Movil</label>
          <div class="input-group input-group-merge">
              <span class="input-group-text">XRS</span>
              <input type="text" id="identidadMovil" name="identidadMovil" class="form-control" placeholder="XRSB70" />
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="chapaMovil">Chapa</label>
          <input type="text" id="chapaMovil" name="chapaMovil" class="form-control" placeholder="Registrar Chapa" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="chasisMovil">Chasis</label>
          <input type="text" id="chasisMovil" name="chasisMovil" class="form-control" placeholder="XXXXXXXXXXXXXXX" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="marcaMovil">Marca</label>
            <input type="text" id="marcaMovil" name="marcaMovil" class="form-control" placeholder="Toyota" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="modeloMovil">Modelo</label>
            <input type="text" id="modeloMovil" name="modeloMovil" class="form-control" placeholder="Land Cruiser" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="yearMovil">Año</label>
            <input type="text" id="yearMovil" name="yearMovil" class="form-control" placeholder="2019" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="tipoMovil">Tipo Movil</label>
            <input type="text" id="tipoMovil" name="tipoMovil" class="form-control" placeholder="Ambulancia" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="tipoAmbulancia">Tipo Ambulancia</label>
            <select id="tipoAmbulancia" name="tipoAmbulancia" class="form-select" aria-label="Default select example">
                <option selected>Tipo</option>
                <option value="1">SVR</option>
                <option value="2">SVB - SIMPLE</option>
                <option value="3">SVB - PLUS</option>
                <option value="4">SVA</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="tarjetaPETROPAR">Petropar Flota</label>
            <input type="text" id="tarjetaPETROPAR" name="tarjetaPETROPAR" class="form-control" placeholder="123 456 7890" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="motorMovil">Motor (cc)</label>
            <input type="number" id="motorMovil" name="motorMovil" class="form-control" placeholder="2000" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="capacidadTanque">Capacidad Tanque (litros)</label>
            <input type="number" id="capacidadTanque" name="capacidadTanque" class="form-control" placeholder="70" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="raspMovil">RASP</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text">C-</span>
                <input type="text" id="raspMovil" name="raspMovil" class="form-control" placeholder="C-0004234" />
            </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="baseMovil">Base Operativa</label>
            <select id="baseMovil" name="baseMovil" class="select2 form-select" data-allow-clear="true">
              @foreach($establecimientos as $establecimiento)
                  <option value="{{ $establecimiento->idEst }}">{{ $establecimiento->NombreEstablecimiento }}</option>
              @endforeach
          </select>
        </div>
        <div class="mb-3">
            <label class="switch">
                <input type="checkbox" class="switch-input" id="switchInoperativo">
                <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                </span>
                <span class="switch-label">Vehículo no operativo?</span>
            </label>
        </div>
        <div class="mb-3" id="ubicacionMovilDiv" style="display: none;">
            <label class="form-label" for="movilUbicacion">Ubicación actual del Móvil</label>
            <input type="text" id="movilUbicacion" name="movilUbicacion" class="form-control" placeholder="Ubicación" />
        </div>

        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
</div>
@endsection
