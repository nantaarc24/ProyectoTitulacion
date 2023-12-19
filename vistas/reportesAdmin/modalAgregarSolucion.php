<form id="frmAgregarSolucionReporte" method="POST" onsubmit="return agregarSolucionReporte()">

  <!-- Modal -->
  <div class="modal fade" id="modalAgregarSolucionReporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar la Solución Técnica</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" name="idReporte" id="idReporte" hidden>
          <label for="solucion">Descripción de la Solución</label>
          <textarea class="form-control" name="solucion" id="solucion" cols="30" rows="10" required></textarea>
          <label for="estatus">Estatus</label>
          <select name="estatus" id="estatus" class="form-control form-select">
            <option value="1">Abierto</option>
            <option value="0">Cerrado</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-success">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>