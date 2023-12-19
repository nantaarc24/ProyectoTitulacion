
<form class="form-control" id="frmActualizarDatosPersonales" method="POST" onsubmit="return actualizarDatosPersonales()">
    <!-- Modal -->
<div class="modal fade" id="modalActualizarDatosPersonales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar datos personales</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <label for="paternoInicio">Apellido Paterno</label>
        <input class="form-control" type="text" name="paternoInicio" id="paternoInicio">

        <label for="maternoInicio">Apellido Materno</label>
        <input class="form-control" type="text" name="maternoInicio" id="maternoInicio">

        <label for="nombreInicio">Nombre</label>
        <input class="form-control" type="text" name="nombreInicio" id="nombreInicio">

        <label for="telefonoInicio">Teléfono</label>
        <input class="form-control" type="text" name="telefonoInicio" id="telefonoInicio">

        <label for="correoInicio">Correo</label>
        <input class="form-control" type="mail" name="correoInicio" id="correoInicio">

        <label for="fechaNacInicio">Fecha de Nacimiento</label>
        <input class="form-control" type="date" name="fechaNacInicio" id="fechaNacInicio">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-warning" style="color: white;">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</form>