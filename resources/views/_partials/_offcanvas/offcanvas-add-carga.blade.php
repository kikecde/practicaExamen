<!-- Add ORDEN DE TRABAJO Sidebar -->
<div class="offcanvas offcanvas-end" id="addcargaOffcanvas" aria-hidden="true">
  <div class="offcanvas-header mb-3">
    <h5 class="offcanvas-title">Generar Recibo</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form>

      <div class="mb-3">
        <label class="form-label" for="carga-type">Origen del recibo</label>
        <select class="form-select" id="carga-type">
          <option value="" selected disabled>Seleccionar Tipo de Origen</option>
          <option value="1">OT Pendiente de Recibo</option>
          <option value="2">OT Extraordinario</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="carga-OT-pendientes">OTs con Recibo Pendiente</label>
        <select class="form-select" id="carga-OT-pendientes">
          <option value="" selected disabled>Seleccionar Orden de Trabajo</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="ot-conductoresSelect" class="form-label">Conductor/es</label>
        <select id="ot-conductoresSelect" name="ot-conductoresSelect" class="select2 form-select" multiple>
        </select>
      </div>
      <div class="d-flex justify-content-between bg-lighter p-2 mb-3 align-items-center">
        <i class='bx bxs-ambulance' style='font-size: 30px; margin-right: 10px;'></i>
        <select class="form-select" id="movilOTCarga">
          <option value="" selected disabled>Seleccione Móvil</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="ot-origen">Origen Orden de Trabajo</label>
        <select class="form-select" id="ot-origen">
          <option value="" selected disabled>Seleccionar Origen</option>
          <option value="1">Genérico</option>
          <option value="2">Pedidos</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="carga-fechaDesde" class="form-label">Fecha/Hora de OT</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="carga-fechaDesde" />
      </div>
      <div class="mb-3">
        <label for="carga-fechaHasta" class="form-label">Fecha/Hora de Final</label>
        <input type="text" class="form-control" placeholder="DD/MM/AAAA HH:MM" id="carga-fechaHasta" />
      </div>
      <div class="mb-3">
        <label for="carga-estabID" class="form-label">Establecimiento/s</label>
        <select  name="carga-estabID" id="carga-estabID" aria-label="Establecimientos" class="select2 form-select" multiple>
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
