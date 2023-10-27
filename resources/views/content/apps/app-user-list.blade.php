@extends('layouts/layoutMaster')

@section('title', 'Lista de Funcionarios - Paginas')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />

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
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-user-list.js')}}"></script>
@endsection

@section('content')

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Funcionarios</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">{{$totalFuncionario}}</h4>
              <small class="text-success">(+100%)</small>
            </div>
            <p class="mb-0">Total Funcionarios</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="bx bx-user bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Médicos</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">{{$medicos}}</h4>
              <small class="text-success">(+44%)</small>
            </div>
            <p class="mb-0">Activos </p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="bx bx-user-check bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Enfermeros</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">{{$enfermeros}}</h4>
              <small class="text-danger">(37%)</small>
            </div>
            <p class="mb-0">De guardia</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
              <i class="bx bx-group bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total de Blanco</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">{{$deblanco}}</h4>
              <small class="text-success">({{$porcentajedeBlanco}}%)</small>
            </div>
            <p class="mb-0">Porcentaje del total</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="bx bx-user-voice bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Users List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Filtro de Búsqueda</h5>
    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
      <div class="col-md-4 user_role"></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th></th>
          <th>Funcionario</th>
          <th>Función/Profesión</th>
          <th>Area</th>
          <th>Establecimiento</th>
          <th>Status</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Agregar Funcionario</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Nombres y Apellidos</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="Nombre Completo" name="userFullname" aria-label="John Doe" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="dr.john@example.com" aria-label="dr.john@ejemplo.com" name="userEmail" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">Telefono</label>
          <input class="form-control prefix-mask" id="add-user-contact" type="text" placeholder="983 123456" aria-label="telefono" name="userContact" />
        </div>
        <div class="row d-flex justify-content-between mb-3">
          <div class="col-6 mb-3">
            <label class="form-label" for="add-user-cedula">Cédula Nro</label>
            <input type="text" id="add-user-cedula" class="form-control" placeholder="7651238" aria-label="nrocedula" name="userCedula" />
          </div>
          <div class="col-6 mb-3">
            <label class="form-label" for="add-user-fNac">Fecha de Nacimiento</label>
            <input type="text" id="add-user-fNac" class="form-control" placeholder="21/09/1992" aria-label="fechaNacimiento" name="userFNAC" />
          </div>
        </div>
        <div class="mb-3">
          <div class="form-check form-check-inline form-check-lg form-check-secondary  mt-3 mb-3">
            <label class="form-check-label" for="sexo_femenino">FEMENINO</label>
            <input class="form-check-input" type="checkbox" name="funcSexo" id="ot_Ordinario" value="F" />
          </div>
          <div class="form-check form-check-secondary form-check-inline mt-3 mb-3">
            <label class="form-check-label" for="sexo_masculino">MASCULINO</label>
            <input class="form-check-input" type="checkbox" name="funcSexo" id="ot_Extraordinario" value="M" />
          </div>
        </div>
        {{-- "user-role" --}}
        <div class="mb-3">
          <label class="form-label" for="func-prof">Profesión/Función</label>
          <select id="func-prof" class="select2 form-select" name="userProfesion">
            <option value="">Seleccione Profesión</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="func-estabID">Establecimiento</label>
          <select id="func-estabID" name="userEstab" class="select2 form-select">
            <option value="">Seleccione Establecimiento</option>

          </select>
        </div>
        {{-- "user-plan" --}}
        <div class="mb-4">
          <label class="form-label" for="func-area">Seleccionar Area</label>
          <select id="func-area" name="userArea" class="select2 form-select">
            <option value="">Seleccione Area</option>

          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
</div>

@endsection



