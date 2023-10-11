<!-- Edit Movil Modal -->
<div class="modal fade" id="editMovil" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-Movil">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        <div class="text-center mb-4">
          <h3>Editar Información de Movil</h3>
          <p>Modificación de datos de moviles requerira auditoría por CEO.</p>
        </div>
        <form id="editMovilForm" class="row g-3" action="{{ route('list.store') }}" method="POST">
          @csrf
          @method('PUT')
          <div class="col-12 col-md-6">
            <label class="form-label" for="identidadMovil">Identidad Movil</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text">XRS</span>
                <input type="text" id="identidadMovil" name="identidadMovil" class="form-control" placeholder="XRSB70" />
            </div>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="chapaMovil">Chapa</label>
            <input type="text" id="chapaMovil" name="chapaMovil" class="form-control" placeholder="Registrar Chapa" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="chasisMovil">Chasis</label>
            <input type="text" id="chasisMovil" name="chasisMovil" class="form-control" placeholder="XXXXXXXXXXXXXXX" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="marcaMovil">Marca</label>
              <input type="text" id="marcaMovil" name="marcaMovil" class="form-control" placeholder="Toyota" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="modeloMovil">Modelo</label>
              <input type="text" id="modeloMovil" name="modeloMovil" class="form-control" placeholder="Land Cruiser" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="yearMovil">Año</label>
              <input type="text" id="yearMovil" name="yearMovil" class="form-control" placeholder="2019" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="tipoMovil">Tipo Movil</label>
              <input type="text" id="tipoMovil" name="tipoMovil" class="form-control" placeholder="Ambulancia" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="tipoAmbulancia">Tipo Ambulancia</label>
              <select id="tipoAmbulancia" name="tipoAmbulancia" class="form-select" aria-label="Default select example">
                  <option selected>Tipo</option>
                  <option value="1">SVR</option>
                  <option value="2">SVB - SIMPLE</option>
                  <option value="3">SVB - PLUS</option>
                  <option value="4">SVA</option>
              </select>
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="tarjetaPETROPAR">Petropar Flota</label>
              <input type="text" id="tarjetaPETROPAR" name="tarjetaPETROPAR" class="form-control" placeholder="123 456 7890" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="motorMovil">Motor (cc)</label>
              <input type="number" id="motorMovil" name="motorMovil" class="form-control" placeholder="2000" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="capacidadTanque">Capacidad Tanque (litros)</label>
              <input type="number" id="capacidadTanque" name="capacidadTanque" class="form-control" placeholder="70" />
          </div>
          <div class="col-12 col-md-6">
              <label class="form-label" for="raspMovil">RASP</label>
              <div class="input-group input-group-merge">
                  <span class="input-group-text">C-</span>
                  <input type="text" id="raspMovil" name="raspMovil" class="form-control" placeholder="C-0004234" />
              </div>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="baseMovil">Base Operativa</label>
              <select id="baseMovil" name="baseMovil" class="select2 form-select" data-allow-clear="true">
                @foreach($establecimientos as $establecimiento)
                    <option value="{{ $establecimiento->idEst }}">{{ $establecimiento->NombreEstablecimiento }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-12">
              <label class="switch">
                  <input type="checkbox" class="switch-input" id="switchInoperativo">
                  <span class="switch-toggle-slider">
                      <span class="switch-on"></span>
                      <span class="switch-off"></span>
                  </span>
                  <span class="switch-label">Vehículo en uso?</span>
              </label>
          </div>
          <div class="col-12 col-md-6" id="ubicacionMovilDiv" style="display: none;">
              <label class="form-label" for="movilUbicacion">Ubicación actual del Móvil</label>
              <input type="text" id="movilUbicacion" name="movilUbicacion" class="form-control" placeholder="Ubicación" />
          </div>


          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Guardar</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit Movil Modal -->
