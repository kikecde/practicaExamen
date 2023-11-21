@extends('layouts/layoutMaster')

@section('title', 'Wizard Numbered - Forms')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/form-establecimiento-config.js')}}"></script>

@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Establecimiento/</span> Estructura
</h4>

<!-- Default -->
<div class="row">
  <div class="col-12">
    <h5>Establecimientos</h5>
  </div>

  <!-- Validation Wizard -->
  <div class="col-12 mb-4">
    <small class="text-light fw-medium">Formulario de Establecimiento</small>
    <div id="wizard-validation" class="bs-stepper mt-2">
      <div class="bs-stepper-header">
        <div class="step" data-target="#estab-basic-info">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Información Básica</span>
              <span class="bs-stepper-subtitle">Configuración Básica del establecimiento</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="step" data-target="#estab-estructura-info">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Estructura del establecimiento</span>
              <span class="bs-stepper-subtitle">Configure la estructura organizacional</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="step" data-target="#estab-capacidad-info">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Capacidades de Internación</span>
              <span class="bs-stepper-subtitle">Configure las capacidades de internación</span>
            </span>
          </button>
        </div>
        <div class="step" data-target="#estab-estructura-noMed">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">4</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Areas No Médicas</span>
              <span class="bs-stepper-subtitle">Configure las Areas y Departamentos no Médicos</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form id="wizard-validation-form" onSubmit="return false">
          <!-- Account Details -->
          <div id="estab-basic-info" class="content">
            <div class="content-header mb-3">
              <div class="row g-3 justify-content-between">
                <div class="col-4 align-start">
                  <h6 class="mb-0">Información Básica</h6>
                  <small>Registre los datos del establecimiento.</small>
                </div>


              </div>
            </div>
            <div class="row  justify-content-between mb-3">
              <div class="col-sm-6 d-flex flex-column justify-content-center ">
                  <label class="form-label" for="estSelect">Buscar Establecimiento</label>
                  <select id="estSelect" class="form-select">
                      <option value="">Seleccionar</option>
                  </select>
              </div>
              <div class="col-sm-4 d-flex  flex-column justify-content-center ">
                <button id="nuevoEstab" class="btn btn-primary d-grid w-100 mb-3 add-new" >
                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bxs-file-plus bx-xs me-1"></i>Crear Establecimiento</span>
                </button>
            </div>
            </div>

            <input type="hidden" name="idEst" id="idEst" value="">

            <div class="row g-3" style="display: none;" id="formEstab">
                <div class="col-sm-6">
                  <label class="form-label" for="estTipo">Tipo de Establecimiento</label>
                  <select id="estTipo" class="form-select" data-allow-clear="true">
                    <option value="">Seleccionar</option>
                    <option value="HR" data-level="4" >HOSPITAL GENERAL REGIONAL</option>
                    <option value="HD" data-level="3" >HOSPITAL DISTRITAL</option>
                    <option value="CS" data-level="2" >CENTRO DE SALUD</option>
                    <option value="USF ESTANDAR" data-level="1" >USF ESTANDAR</option>
                    <option value="USF AMPLIADA" data-level="1" >USF AMPLIADA</option>
                    <option value="USF SATELITE" data-level="1" >USF SATELITE</option>
                    <option value="USF MOVIL" data-level="1" >USF MOVIL</option>
                    <option value="PS" data-level="1" >PUESTO DE SALUD</option>
                    <option value="HE" data-level="5" >HOSPITAL ESPECIALIZADO</option>
                    <option value="PV" data-level="7" >PRIVADO</option>
                    <option value="HR IPS" data-level="6" >HOSPITAL REGIONAL IPS</option>
                    <option value="US IPS " data-level="6" >UNIDAD DE SALUD IPS</option>
                    <option value="PS IPS" data-level="6" >PUESTO DE SALUD IPS</option>
                    <option value="ADM" data-level="8" >ADMINISTRATIVO</option>
                    <option value="CDN" data-level="8" >COORDINACION</option>
                    <option value="HGN" data-level="5" >HOSPITAL GENERAL NACIONAL</option>
                    <option value="PUB" data-level="8" >OTRO PUBLICO</option>
                  </select>
                </div>
                <input type="hidden" name="estNivel" name="estNivel" id="estNivel" value="">
                <div class="col-sm-6">
                  <label class="form-label" for="NombreEstablecimiento">Nombre Establecimiento</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text" id="siglasEst"> </span>
                    <input type="text" class="form-control" id="NombreEstablecimiento" name="NombreEstablecimiento" placeholder="Ingresar nombre establecimiento"/>
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="estAbrev">Abreviación</label>
                  <input type="text" id="estAbrev" name="estAbrev" class="form-control" placeholder="HRCDE" />
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="estRegionID">Región Sanitaria</label>
                  <select id="estRegionID" name="estRegionID" class="form-select" data-allow-clear="true">>
                    <option value="">Seleccionar</option>
                    <option value="1">I</option>
                    <option value="2">II</option>
                    <option value="3">III</option>
                    <option value="4">IV</option>
                    <option value="5">V</option>
                    <option value="6">VI</option>
                    <option value="7">VII</option>
                    <option value="8">VIII</option>
                    <option value="9">IX</option>
                    <option value="10">X</option>
                    <option value="11">XI</option>
                    <option value="12">XII</option>
                    <option value="13">XIII</option>
                    <option value="14">XIV</option>
                    <option value="15">XV</option>
                    <option value="16">XVI</option>
                    <option value="17">XVII</option>
                    <option value="18">XVIII</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="estDistritoID">Distrito</label>
                  <select id="estDistritoID" name="estDistritoID" class="form-select">
                    <option value="" >Seleccionar</option>
                  </select>
                </div>

                <div class="col-sm-6">
                  <label class="form-label" for="estMail">Correo Institucional</label>
                    <input type="text" id="estMail" name="estMail" class="form-control" placeholder="hrcde@mspbs.gov.py"  />
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="estTelefono">Telefono</label>
                  <input class="form-control prefix-mask" name="estTelefono" id="estTelefono" type="text" placeholder="983 123456" aria-label="telefono"  />
                </div>





              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled>
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Estructura Info -->
          <div id="estab-estructura-info" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Configurar estructura del Establecimiento</h6>
              <small>Agregar Areas, Servicios, Departamentos y Sectores. No olvide incluir albergues y similares</small>
            </div>
            <div class="row g-3 mt-3">
              <div class="row mb-3 d-flex justify-content-between">
                <div class="col-sm-10">
                  <label for="estabAreas" class="form-label">Areas del Establecimiento</label>
                  <input id="estabAreas" class="form-control" name="estabAreas"  />
                </div>
                <div class="col-sm-2 align-self-center">
                  <button class="btn btn-success btn-listo1" >
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
                    <i class="bx bx-check bx-sm me-sm-n2"></i>
                  </button>
                </div>
              </div>

              <div class="row mb-3 justify-content-between" style="display: none;" id="estabServiciosDiv">
                <hr>
                <div class="col-sm-10">
                  <label for="estabServicios" class="form-label">Servicios Médicos que posee el establecimiento</label>
                  <input id="estabServicios" class="form-control" name="estabServicios"  />
                </div>
                <div class="col-sm-2 align-self-center">
                  <button class="btn btn-success btn-listo2" >
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
                    <i class="bx bx-check bx-sm me-sm-n2"></i>
                  </button>
                </div>
              </div>

              <div class="row mb-3 justify-content-between" style="display: none;" id="estabSectoresDiv">
                <hr>
                <div class="col-sm-10">
                  <label for="estabSectores" class="form-label">Sectores Médicos que posee el Establecimiento</label>
                  <input id="estabSectores" class="form-control" name="estabSectores"  />
                </div>
                <div class="col-sm-2 align-self-center">
                  <button class="btn btn-success btn-listo3">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
                    <i class="bx bx-check bx-sm me-sm-n2"></i>
                  </button>
                </div>
              </div>


              <div class="row mb-3 justify-content-between" style="display: none;" id="servicioDeptoBloqueDiv">
                <hr>

                <div class="content-header mb-3">
                  <h6 class="mb-0">Departamentos que componen los servicios médicos</h6>
                  <small>Seleccione todos los departamentos a sus respectivos servicios (No puede existir un servicio sin departamento).</small>
                </div>

                <div id="servicioDeptoDiv-1" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-1">Servicio</label>
                  <input id="servicio-depto-1" class="form-control" />
                  <input id="servicio-value-1" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-2" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-2">Servicio</label>
                  <input id="servicio-depto-2" class="form-control" />
                  <input id="servicio-value-2" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-3" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-3">Servicio</label>
                  <input id="servicio-depto-3" class="form-control" />
                  <input id="servicio-value-3" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-4" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-4">Servicio</label>
                  <input id="servicio-depto-4" class="form-control" />
                  <input id="servicio-value-4" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-5" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-5">Servicio</label>
                  <input id="servicio-depto-5" class="form-control" />
                  <input id="servicio-value-5" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-6" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-6">Servicio</label>
                  <input id="servicio-depto-6" class="form-control" />
                  <input id="servicio-value-6" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-7" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-7">Servicio</label>
                  <input id="servicio-depto-7" class="form-control" />
                  <input id="servicio-value-7" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-8" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-8">Servicio</label>
                  <input id="servicio-depto-8" class="form-control" />
                  <input id="servicio-value-8" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-9" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-9">Servicio</label>
                  <input id="servicio-depto-9" class="form-control" />
                  <input id="servicio-value-9" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-10" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-10">Servicio</label>
                  <input id="servicio-depto-10" class="form-control" />
                  <input id="servicio-value-10" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-11" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-11">Servicio</label>
                  <input id="servicio-depto-11" class="form-control" />
                  <input id="servicio-value-11" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-12" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-12">Servicio</label>
                  <input id="servicio-depto-12" class="form-control" />
                  <input id="servicio-value-12" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-13" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-13">Servicio</label>
                  <input id="servicio-depto-13" class="form-control" />
                  <input id="servicio-value-13" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-14" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-14">Servicio</label>
                  <input id="servicio-depto-14" class="form-control" />
                  <input id="servicio-value-14" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-15" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-15">Servicio</label>
                  <input id="servicio-depto-15" class="form-control" />
                  <input id="servicio-value-15" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-16" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-16">Servicio</label>
                  <input id="servicio-depto-16" class="form-control" />
                  <input id="servicio-value-16" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-17" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-17">Servicio</label>
                  <input id="servicio-depto-17" class="form-control" />
                  <input id="servicio-value-17" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-18" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-18">Servicio</label>
                  <input id="servicio-depto-18" class="form-control" />
                  <input id="servicio-value-18" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-19" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-19">Servicio</label>
                  <input id="servicio-depto-19" class="form-control" />
                  <input id="servicio-value-19" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>

                  <div id="servicioDeptoDiv-20" class="justify-content-between" style="display:none;">
                  <div class="mb-3 col-12">
                  <label class="form-label" for="servicio-depto-20">Servicio</label>
                  <input id="servicio-depto-20" class="form-control" />
                  <input id="servicio-value-20" type="hidden" class="servicio-value" value=""/>
                  </div>
                  </div>


                  <div class="col-sm-6 mb-3 align-self-center">
                    <button class="btn btn-success btn-listo4" >
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
                      <i class="bx bx-check bx-sm me-sm-n2"></i>
                    </button>
                  </div>

                  <hr>
              </div>


              <div class="row g-3" id="estabSectoresDeptosDiv" style="display: none;">
                <div class="content-header mb-3">
                  <h6 class="mb-0">Sectores de atención de los Departamentos</h6>
                  <small>Asigne todos los departamentos a sus respectivos sectores. (No puede existir un departamento sin un sector.)</small>
                </div>


                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-1" style="display: none;">
                  <label for="estabSector-1" class="form-label">Sector</label>
                  <select id="estabSector-1" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-2" style="display: none;">
                  <label for="estabSector-2" class="form-label">Sector</label>
                  <select id="estabSector-2" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-3" style="display: none;">
                  <label for="estabSector-3" class="form-label">Sector</label>
                  <select id="estabSector-3" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-4" style="display: none;">
                  <label for="estabSector-4" class="form-label">Sector</label>
                  <select id="estabSector-4" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-5" style="display: none;">
                  <label for="estabSector-5" class="form-label">Sector</label>
                  <select id="estabSector-5" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-6" style="display: none;">
                  <label for="estabSector-6" class="form-label">Sector</label>
                  <select id="estabSector-6" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-7" style="display: none;">
                  <label for="estabSector-7" class="form-label">Sector</label>
                  <select id="estabSector-7" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-8" style="display: none;">
                  <label for="estabSector-8" class="form-label">Sector</label>
                  <select id="estabSector-8" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-9" style="display: none;">
                  <label for="estabSector-9" class="form-label">Sector</label>
                  <select id="estabSector-9" class="select2 form-select" multiple>
                  </select>
                </div>
                <div class="sm-12 mb-3" id="estabSectorDeptoDiv-10" style="display: none;">
                  <label for="estabSector-10" class="form-label">Sector</label>
                  <select id="estabSector-10" class="select2 form-select" multiple>
                  </select>
                </div>

                <div class="col-sm-6 mb-3 align-self-center">
                  <button class="btn btn-success btn-listo5" >
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
                    <i class="bx bx-check bx-sm me-sm-n2"></i>
                  </button>
                </div>

                <hr>

              </div>

              <input type="hidden" name="servdeptos" id="servdeptos" value="">



              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                </button>
                <button id="btn-listo7" class="btn btn-primary btn-next" disabled>
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Internacion -->
          <div id="estab-capacidad-info" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Sector de Internación y Capacidad</h6>
              <small>Marque los departamentos con capacidad de internación, seleccione el tipo de sala, la cantidad de camas operativas y en que Sala se agrupará la capacidad.</small>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv1" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion1" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn1" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo1" aria-label="tipoInternacion">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades1" id="capSectorIntUnidades1" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio1" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv2" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion2" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn2" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo2" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades2" id="capSectorIntUnidades2" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio2" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv3" style="display: none;">
              <div class="col-md-6 col-6">
                <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion3" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn3" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo3" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades3" id="capSectorIntUnidades3" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio3" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv4" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion4" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn4" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo4" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades4" id="capSectorIntUnidades4" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio4" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv5" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion5" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn5" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo5" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades5" id="capSectorIntUnidades5" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio5" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv6" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion6" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn6" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo6" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades6" id="capSectorIntUnidades6" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio6" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv7" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion7" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn7" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo7" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades7" id="capSectorIntUnidades7" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio7" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv8" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion8" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn8" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo8" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades8" id="capSectorIntUnidades8" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio8" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv9" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion9" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn9" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo9" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades9" id="capSectorIntUnidades9" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio9" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv10" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion10" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn10" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo10" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades10" id="capSectorIntUnidades10" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio10" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv11" style="display: none;">
              <div class="col-md-6 col-6">
                  <div class="input-group">
                      <div class="input-group-text">
                          <input id="capSectorPoseeInternacion11" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                      </div>
                      <button id="capSectorBtn11" class="btn btn-secondary" type="button">Servicio</button>
                      <select class="form-select" id="capSectorIntTipo11" aria-label="tipoInternacion" placeholder="Tipo Sala">
                        <option value=""></option>
                        <option value="1">Fijo</option>
                        <option value="2">Albergue</option>
                        <option value="3">Contingencia</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades11" id="capSectorIntUnidades11" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio11" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3 align-items-center justify-content-between" id="capSectorInternacionDiv12" style="display: none;">
              <div class="col-md-6 col-6">
                <div class="input-group">
                  <div class="input-group-text">
                      <input id="capSectorPoseeInternacion12" class="form-check-input mt-0" type="checkbox" value="" aria-label="Posee Internación">
                  </div>
                  <button id="capSectorBtn12" class="btn btn-secondary" type="button">Servicio</button>
                  <select class="form-select" id="capSectorIntTipo12" aria-label="tipoInternacion" placeholder="Tipo Sala">
                    <option value=""></option>
                    <option value="1">Fijo</option>
                    <option value="2">Albergue</option>
                    <option value="3">Contingencia</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row align-items-center justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="col-md-4 col-4 me-2">
                      <input class="form-control" name="capSectorIntUnidades12" id="capSectorIntUnidades12" type="number" placeholder="Camas Operativas" aria-label="camasOperativas" />
                    </div>
                    <div class="col-md-8 col-8">
                      <select class="form-select" id="capSectorIntServicio12" aria-label="InternacionServicio" placeholder="Seleccione Sala">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex justify-content-between">
              <button class="btn btn-primary btn-prev">
                <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                <span class="align-middle d-sm-inline-block d-none">Anterior</span>
              </button>
              <button id="btn-listo8" class="btn btn-primary btn-next" >
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Siguiente</span>
                <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
              </button>
            </div>




          </div>




          <!-- No medicos -->
        <div id="estab-estructura-noMed" class="content">
          <div class="content-header mb-3">
            <h6 class="mb-0">Areas y Departamentos no Médicos</h6>
            <small>Asigen Departamentos a las diversas areas no médicas del establecimiento.</small>
          </div>

          <div class="row mb-3 justify-content-between"  id="servicioDeptoBloqueDiv">

            <div id="areaDeptoNoMedDiv-1" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-1">Area</label>
              <input id="areaDeptoNoMed-1" class="form-control" />
              <input id="area-value-1" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-2" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-2">Area</label>
              <input id="areaDeptoNoMed-2" class="form-control" />
              <input id="area-value-2" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-3" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-3">Area</label>
              <input id="areaDeptoNoMed-3" class="form-control" />
              <input id="area-value-3" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-4" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-4">Area</label>
              <input id="areaDeptoNoMed-4" class="form-control" />
              <input id="area-value-4" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-5" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-5">Area</label>
              <input id="areaDeptoNoMed-5" class="form-control" />
              <input id="area-value-5" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-6" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-6">Area</label>
              <input id="areaDeptoNoMed-6" class="form-control" />
              <input id="area-value-6" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-7" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-7">Area</label>
              <input id="areaDeptoNoMed-7" class="form-control" />
              <input id="area-value-7" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-8" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-8">Area</label>
              <input id="areaDeptoNoMed-8" class="form-control" />
              <input id="area-value-8" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-9" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-9">Area</label>
              <input id="areaDeptoNoMed-9" class="form-control" />
              <input id="area-value-9" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-10" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-10">Area</label>
              <input id="areaDeptoNoMed-10" class="form-control" />
              <input id="area-value-10" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-11" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-11">Area</label>
              <input id="areaDeptoNoMed-11" class="form-control" />
              <input id="area-value-11" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-12" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-12">Area</label>
              <input id="areaDeptoNoMed-12" class="form-control" />
              <input id="area-value-12" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-13" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-13">Area</label>
              <input id="areaDeptoNoMed-13" class="form-control" />
              <input id="area-value-13" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-14" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-14">Area</label>
              <input id="areaDeptoNoMed-14" class="form-control" />
              <input id="area-value-14" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-15" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-15">Area</label>
              <input id="areaDeptoNoMed-15" class="form-control" />
              <input id="area-value-15" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-16" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-16">Area</label>
              <input id="areaDeptoNoMed-16" class="form-control" />
              <input id="area-value-16" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-17" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-17">Area</label>
              <input id="areaDeptoNoMed-17" class="form-control" />
              <input id="area-value-17" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-18" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-18">Area</label>
              <input id="areaDeptoNoMed-18" class="form-control" />
              <input id="area-value-18" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-19" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-19">Area</label>
              <input id="areaDeptoNoMed-19" class="form-control" />
              <input id="area-value-19" type="hidden" class="area-value" value=""/>
              </div>
              </div>

              <div id="areaDeptoNoMedDiv-20" class="justify-content-between" style="display:none;">
              <div class="mb-3 col-12">
              <label class="form-label" for="areaDeptoNoMed-20">Area</label>
              <input id="areaDeptoNoMed-20" class="form-control" />
              <input id="area-value-20" type="hidden" class="area-value" value=""/>
              </div>
              </div>


          </div>




          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Anterior</span>
            </button>
            <button class="btn btn-success btn-next btn-submit">Guardar</button>
          </div>
        </div>





          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Validation Wizard -->

  <!-- Offcanvas to add departamentos -->
  {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddEstab" aria-labelledby="offcanvasAddEstabLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddEstabLabel" class="offcanvas-title">Agregar Departamentos a los Servicios</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="form-repeater"  id="addNewEstabForm">
        @csrf

        <div data-repeater-list="group-a">
          <!-- El primer elemento está oculto y sirve como plantilla -->
          <div data-repeater-item style="display:none;">
            <div class="row d-flex justify-content-between">
              <div class="mb-3 col-11">
                <label class="form-label" for="servicio-depto-">Servicio</label>
                <input id="servicio-depto-" class="form-control" />
                <input id="servicio-value-" type="hidden" class="servicio-value" value=""/>
              </div>
              <div class="mb-3 col-1 align-items-center mb-0" style="display:none;">
                <button class="btn btn-label-danger mt-4" data-repeater-delete>
                  <i class="bx bx-x me-1"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-between" style="display:none;">
          <div class="col-sm-6 align-self-center mb-3">
            <button class="btn btn-primary" data-repeater-create>
              <i class="bx bx-plus me-1"></i>
              <span class="align-middle">Servicios</span>
            </button>
          </div>
          <div class="col-sm-6 align-self-center mb-3" style="display:none;">
            <button class="btn btn-primary btn-listo3">
              <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
              <i class="bx bx-check bx-sm me-sm-n2"></i>
            </button>
          </div>
        </div>

        <hr>
        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-sm-6 align-self-center">
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Atras</button>
          </div>
          <div class="col-sm-6 align-self-center">
            <button class="btn btn-success btn-listo5" data-bs-dismiss="offcanvas" >
              <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
              <i class="bx bx-check bx-sm me-sm-n2"></i>
            </button>
          </div>
        </div>
      </form>

    </div>

</div> --}}

<!-- Offcanvas to add sectores -->

{{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddSectores" aria-labelledby="offcanvasAddSectoresLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasAddSectoresLabel" class="offcanvas-title">Asignar Departamentos a los Sectores</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mx-0 flex-grow-0">
    <form class="form-sectores"  id="addNewSectoresForm">
      @csrf
      <div class="row g-3">
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-1" style="display: none;">
          <label for="estabSector-1" class="form-label">Sector</label>
          <select id="estabSector-1" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-2" style="display: none;">
          <label for="estabSector-2" class="form-label">Sector</label>
          <select id="estabSector-2" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-3" style="display: none;">
          <label for="estabSector-3" class="form-label">Sector</label>
          <select id="estabSector-3" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-4" style="display: none;">
          <label for="estabSector-4" class="form-label">Sector</label>
          <select id="estabSector-4" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-5" style="display: none;">
          <label for="estabSector-5" class="form-label">Sector</label>
          <select id="estabSector-5" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-6" style="display: none;">
          <label for="estabSector-6" class="form-label">Sector</label>
          <select id="estabSector-6" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-7" style="display: none;">
          <label for="estabSector-7" class="form-label">Sector</label>
          <select id="estabSector-7" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-8" style="display: none;">
          <label for="estabSector-8" class="form-label">Sector</label>
          <select id="estabSector-8" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-9" style="display: none;">
          <label for="estabSector-9" class="form-label">Sector</label>
          <select id="estabSector-9" class="select2 form-select" multiple>
          </select>
        </div>
        <div class="sm-12 mb-3" id="estabSectorDeptoDiv-10" style="display: none;">
          <label for="estabSector-10" class="form-label">Sector</label>
          <select id="estabSector-10" class="select2 form-select" multiple>
          </select>
        </div>
      </div>





      <hr>
      <div class="row d-flex justify-content-between align-items-center">
        <div class="col-sm-6 align-self-center">
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Atras</button>
        </div>
        <div class="col-sm-6 align-self-center">
          <button class="btn btn-success btn-listo6" data-bs-dismiss="offcanvas">
            <span class="align-middle d-sm-inline-block d-none me-sm-1">Listo!</span>
            <i class="bx bx-check bx-sm me-sm-n2"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div> --}}


  {{-- <!-- Vertical Wizard -->
  <div class="col-12 mb-4">
    <small class="text-light fw-medium">Vertical</small>
    <div class="bs-stepper wizard-vertical vertical mt-2">
      <div class="bs-stepper-header">
        <div class="step" data-target="#account-details-1">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Account Details</span>
              <span class="bs-stepper-subtitle">Setup Account Details</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#personal-info-1">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Personal Info</span>
              <span class="bs-stepper-subtitle">Add personal info</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#social-links-1">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Social Links</span>
              <span class="bs-stepper-subtitle">Add social links</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form onSubmit="return false">
          <!-- Account Details -->
          <div id="account-details-1" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Account Details</h6>
              <small>Enter Your Account Details.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="username-vertical">Username</label>
                <input type="text" id="username-vertical" class="form-control" placeholder="johndoe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="email-vertical">Email</label>
                <input type="email" id="email-vertical" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="password-vertical">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password-vertical" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password2-vertical" />
                  <span class="input-group-text cursor-pointer" id="password2-vertical"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="confirm-password-vertical">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password-vertical" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password-vertical2" />
                  <span class="input-group-text cursor-pointer" id="confirm-password-vertical2"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled>
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Personal Info -->
          <div id="personal-info-1" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Personal Info</h6>
              <small>Enter Your Personal Info.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="first-name-vertical">First Name</label>
                <input type="text" id="first-name-vertical" class="form-control" placeholder="John" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="last-name-vertical">Last Name</label>
                <input type="text" id="last-name-vertical" class="form-control" placeholder="Doe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="country-vertical">Country</label>
                <select class="select2" id="country-vertical">
                  <option label=" "></option>
                  <option>UK</option>
                  <option>USA</option>
                  <option>Spain</option>
                  <option>France</option>
                  <option>Italy</option>
                  <option>Australia</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="language-vertical">Language</label>
                <select class="selectpicker w-auto" id="language-vertical" data-style="btn-transparent" data-icon-base="bx" data-tick-icon="bx-check text-white" multiple>
                  <option>English</option>
                  <option>French</option>
                  <option>Spanish</option>
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Social Links -->
          <div id="social-links-1" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Social Links</h6>
              <small>Enter Your Social Links.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="twitter-vertical">Twitter</label>
                <input type="text" id="twitter-vertical" class="form-control" placeholder="https://twitter.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="facebook-vertical">Facebook</label>
                <input type="text" id="facebook-vertical" class="form-control" placeholder="https://facebook.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="google-vertical">Google+</label>
                <input type="text" id="google-vertical" class="form-control" placeholder="https://plus.google.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="linkedin-vertical">LinkedIn</label>
                <input type="text" id="linkedin-vertical" class="form-control" placeholder="https://linkedin.com/abc" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-success btn-submit">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Vertical Wizard -->
</div>
<hr class="container-m-nx mb-5">

<!-- Modern -->
<div class="row">
  <div class="col-12">
    <h5>Modern</h5>
  </div>

  <!-- Modern Wizard -->
  <div class="col-12 mb-4">
    <small class="text-light fw-medium mt-2">Basic</small>
    <div class="bs-stepper wizard-modern wizard-modern-example mt-2">
      <div class="bs-stepper-header">
        <div class="step" data-target="#account-details-modern">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Account Details</span>
              <span class="bs-stepper-subtitle">Setup Account Details</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="step" data-target="#personal-info-modern">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Personal Info</span>
              <span class="bs-stepper-subtitle">Add personal info</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="bx bx-chevron-right"></i>
        </div>
        <div class="step" data-target="#social-links-modern">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Social Links</span>
              <span class="bs-stepper-subtitle">Add social links</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form onSubmit="return false">
          <!-- Account Details -->
          <div id="account-details-modern" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Account Details</h6>
              <small>Enter Your Account Details.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="username-modern">Username</label>
                <input type="text" id="username-modern" class="form-control" placeholder="johndoe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="email-modern">Email</label>
                <input type="email" id="email-modern" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="password-modern">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password-modern" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password2-modern" />
                  <span class="input-group-text cursor-pointer" id="password2-modern"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="confirm-password-modern">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password-modern" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password-modern2" />
                  <span class="input-group-text cursor-pointer" id="confirm-password-modern2"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled>
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Personal Info -->
          <div id="personal-info-modern" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Personal Info</h6>
              <small>Enter Your Personal Info.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="first-name-modern">First Name</label>
                <input type="text" id="first-name-modern" class="form-control" placeholder="John" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="last-name-modern">Last Name</label>
                <input type="text" id="last-name-modern" class="form-control" placeholder="Doe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="country-modern">Country</label>
                <select class="select2" id="country-modern">
                  <option label=" "></option>
                  <option>UK</option>
                  <option>USA</option>
                  <option>Spain</option>
                  <option>France</option>
                  <option>Italy</option>
                  <option>Australia</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="language-modern">Language</label>
                <select class="selectpicker w-auto" id="language-modern" data-style="btn-transparent" data-icon-base="bx" data-tick-icon="bx-check text-white" multiple>
                  <option>English</option>
                  <option>French</option>
                  <option>Spanish</option>
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Social Links -->
          <div id="social-links-modern" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Social Links</h6>
              <small>Enter Your Social Links.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="twitter-modern">Twitter</label>
                <input type="text" id="twitter-modern" class="form-control" placeholder="https://twitter.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="facebook-modern">Facebook</label>
                <input type="text" id="facebook-modern" class="form-control" placeholder="https://facebook.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="google-modern">Google+</label>
                <input type="text" id="google-modern" class="form-control" placeholder="https://plus.google.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="linkedin-modern">LinkedIn</label>
                <input type="text" id="linkedin-modern" class="form-control" placeholder="https://linkedin.com/abc" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-success btn-submit">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Modern Wizard -->

  <!-- Modern Vertical Wizard -->
  <div class="col-12">
    <small class="text-light fw-medium">Vertical</small>
    <div class="bs-stepper vertical wizard-modern wizard-modern-vertical mt-2">
      <div class="bs-stepper-header">
        <div class="step" data-target="#account-details-modern-vertical">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Account Details</span>
              <span class="bs-stepper-subtitle">Setup Account Details</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#personal-info-modern-vertical">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Personal Info</span>
              <span class="bs-stepper-subtitle">Add personal info</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#social-links-modern-vertical">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Social Links</span>
              <span class="bs-stepper-subtitle">Add social links</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form onSubmit="return false">
          <!-- Account Details -->
          <div id="account-details-modern-vertical" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Account Details</h6>
              <small>Enter Your Account Details.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="username-modern-vertical">Username</label>
                <input type="text" id="username-modern-vertical" class="form-control" placeholder="johndoe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="email-modern-vertical">Email</label>
                <input type="email" id="email-modern-vertical" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="password-modern-vertical">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password-modern-vertical" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password2-modern-vertical" />
                  <span class="input-group-text cursor-pointer" id="password2-modern-vertical"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="col-sm-6 form-password-toggle">
                <label class="form-label" for="confirm-password-modern-vertical">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm-password-modern-vertical" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirm-password-modern-vertical2" />
                  <span class="input-group-text cursor-pointer" id="confirm-password-modern-vertical2"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled>
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Personal Info -->
          <div id="personal-info-modern-vertical" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Personal Info</h6>
              <small>Enter Your Personal Info.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="first-name-modern-vertical">First Name</label>
                <input type="text" id="first-name-modern-vertical" class="form-control" placeholder="John" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="last-name-modern-vertical">Last Name</label>
                <input type="text" id="last-name-modern-vertical" class="form-control" placeholder="Doe" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="country-modern-vertical">Country</label>
                <select class="select2" id="country-modern-vertical">
                  <option label=" "></option>
                  <option>UK</option>
                  <option>USA</option>
                  <option>Spain</option>
                  <option>France</option>
                  <option>Italy</option>
                  <option>Australia</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="language-modern-vertical">Language</label>
                <select class="selectpicker w-auto" id="language-modern-vertical" data-style="btn-transparent" data-icon-base="bx" data-tick-icon="bx-check text-white" multiple>
                  <option>English</option>
                  <option>French</option>
                  <option>Spanish</option>
                </select>
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Social Links -->
          <div id="social-links-modern-vertical" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Social Links</h6>
              <small>Enter Your Social Links.</small>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label" for="twitter-modern-vertical">Twitter</label>
                <input type="text" id="twitter-modern-vertical" class="form-control" placeholder="https://twitter.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="facebook-modern-vertical">Facebook</label>
                <input type="text" id="facebook-modern-vertical" class="form-control" placeholder="https://facebook.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="google-modern-vertical">Google+</label>
                <input type="text" id="google-modern-vertical" class="form-control" placeholder="https://plus.google.com/abc" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="linkedin-modern-vertical">LinkedIn</label>
                <input type="text" id="linkedin-modern-vertical" class="form-control" placeholder="https://linkedin.com/abc" />
              </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-prev">
                  <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-success btn-submit">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Modern Vertical Wizard --> --}}
{{-- </div> --}}

@endsection
