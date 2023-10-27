<!-- Add ORDEN DE TRABAJO Sidebar -->
<div class="offcanvas offcanvas-end" id="addOtOffcanvas" aria-hidden="true">
  <div class="offcanvas-header mb-3">
    <h5 class="offcanvas-title">Crear Orden de Trabajo</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form>
      <div class="d-flex justify-content-between bg-lighter p-2 mb-3 align-items-center">
        <i class='bx bxs-ambulance' style='font-size: 30px; margin-right: 10px;'></i>
        <select class="form-select" id="movilOT">
          <option value="" selected disabled>Seleccione Móvil</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="ot-type">Tipo de Orden de Trabajo</label>
        <select class="form-select" id="ot-type">
          <option value="" selected disabled>Seleccionar Tipo de OT</option>
          <option value="1">Ordinario</option>
          <option value="2">Extraordinario</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="ot-conductoresSelect" class="form-label">Conductor/es</label>
        <select id="ot-conductoresSelect" name="ot-conductoresSelect" class="select2 form-select" multiple>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="ot-origen">Origen Orden de Trabajo</label>
        <select class="form-select" id="ot-origen">
          <option value="" selected disabled>Seleccionar Origen</option>
          <option value="1">Genérico</option>
          <option value="2">Pedidos de Traslado</option>
          <option value="2">Logístico/Mecánico</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="ot-fechaDesde" class="form-label">Fecha/Hora de Inicio</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="ot-fechaDesde" />
      </div>
      <div class="mb-3">
        <label for="ot-fechaHasta" class="form-label">Fecha/Hora de Final</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="ot-fechaHasta" />
      </div>
      <div class="mb-3">
        <label for="ot-estabID" class="form-label">Establecimiento/s</label>
        <select  name="ot-estabID" id="ot-estabID" aria-label="Establecimientos" class="select2 form-select" multiple>
        </select>
      </div>

      <div class="mb-3 d-flex flex-wrap">
        <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Listo</button>
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </div>
    </form>
  </div>
</div>
<!-- /Add OT Sidebar -->
