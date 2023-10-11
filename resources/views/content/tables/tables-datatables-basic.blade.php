@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<!-- Row Group CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}">
<!-- Form Validation -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<!-- Form Validation -->
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/tables-datatables-basic2.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">DataTables /</span> Basic
</h4>



<!-- DataTable with Buttons -->
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
<!-- Modal to add new record -->
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
<!--/ DataTable with Buttons -->


@endsection
