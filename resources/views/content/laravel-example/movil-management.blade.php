@extends('layouts/layoutMaster')

@section('title', 'Ambulancias - Gestion')

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
    <h5 class="card-title mb-0">Filtro de Búsqueda</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-moviles table border-top">
      <thead>
        <tr>
          <th></th>
          <th>Id</th>
          <th>Móvil</th>
          <th>Base Operativa</th>
          <th>Tipo Movil / Status</th>
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
          <label class="form-label" for="add-movil-identidadMovil">Identidad Movil</label>
          <input type="text" class="form-control" id="add-movil-IdentidadMovil" placeholder="XRSB10" name="identidadMovil" aria-label="XRSB10" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-chapaMovil">Chapa</label>
          <input type="text" id="add-movil-chapaMovil" class="form-control" placeholder="Ingrese chapa del movil" aria-label="XXX000" name="chapaMovil" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-chasisMovil">Chasis</label>
          <input type="text" id="add-movil-chasisMovil" class="form-control" placeholder="Ingrese Nro de Chasis" aria-label="XXXXXXXXXXXXXXXXX" name="chasisMovil" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-marcaMovil">Marca del Vehiculo</label>
          <select id="add-movil-marcaMovil" class="select2 form-select">
            <option value="">Select</option>
            <option value="1">Mercedes Benz</option>
            <option value="2">Isuzu</option>
            <option value="3">Hyundai</option>
            <option value="4">Renault</option>
            <option value="5">Chevrolet</option>
            <option value="6">Toyota</option>
            <option value="7">Ford</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-modeloMovil">Modelo del Vehiculo</label>
          <input type="text" id="add-movil-modeloMovil" class="form-control" placeholder="Sprinter" aria-label="Modelo de Movil" name="modeloMovil" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-tipoMovil">Tipo de Vehículo</label>
          <select id="add-movil-tipoMovil" class="select2 form-select">
            <option value="">Select</option>
            <option value="300">Ambulancia</option>
            <option value="4">Automovil</option>
            <option value="5">Camioneta</option>
            <option value="6">Camión</option>
            <option value="7">Motocicleta</option>
            <option value="8">Camion Pequeño</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-tipoAmbulancia">Tipo de Ambulancia</label>
          <input type="number" id="add-movil-tipoAmbulancia" class="form-control" placeholder="SVB - SIMPLE" aria-label="Tipo de Ambulancia" name="tipoAmbulancia" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-añoMovil">Año del Vehiculo</label>
          <input type="number" id="add-movil-añoMovil" class="form-control" placeholder="2020" aria-label="Año de Movil" name="añoMovil" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-motorMovil">CC del motor</label>
          <input type="number" id="add-movil-motorMovil" class="form-control" placeholder="2000" aria-label="Motor de Movil" name="motorMovil" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-capacidadTanque">Capacidad Tanque Combustible</label>
          <input type="number" id="add-movil-capacidadTanque" class="form-control" placeholder="70" aria-label="Capacidad de tanque en litros" name="capacidadTanque" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-raspMovil">Codigo de RASP</label>
          <input type="number" id="add-movil-raspMovil" class="form-control" placeholder="C-XXXXXXX" aria-label="Codigo de RASP" name="raspMovil" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-movil-baseMovil">Base Operativa</label>
          <select id="add-movil-baseMovil" class="select2 form-select">
            <option value="">Select</option>
            <option value="300">SEME XRS</option>
            <option value="4">HRCDE</option>
            <option value="5">HDH</option>
            <option value="6">HDPF</option>
            <option value="7">HDMG</option>
            <option value="8">HDSR</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardad</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
</div>
@endsection
