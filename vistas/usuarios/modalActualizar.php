<!-- Modal -->
<!-- <script src="../../public/js/usuarios/usuarios.js"></script> -->
<form id="frmActualizarUsuario" method="POST" onsubmit="return actualizarUsuario()">
    <div class="modal fade" id="modalActualizarUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar usuario</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="idUsuario" id="idUsuario" hidden>
                    <!-- fila 1 -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="paternou">Apellido Paterno</label>
                            <input type="text" class="form-control" name="paternou" required id="paternou">
                        </div>

                        <div class="col-sm-4">
                            <label for="maternou">Apellido Materno</label>
                            <input type="text" class="form-control" name="maternou" required id="maternou">
                        </div>

                        <div class="col-sm-4">
                            <label for="nombreu">Nombre</label>
                            <input type="text" class="form-control" name="nombreu" required id="nombreu">
                        </div>
                    </div>
                    <!-- fila 2 -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="fechaNacimientou">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimientou" id="fechaNacimientou" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="sexou">Sexo</label>
                            <select class="form-control form-select" name="sexou" id="sexou" required>
                                <option value=""></option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="telefonou">Teléfono</label>
                            <input type="text" class="form-control" name="telefonou" id="telefonou" required>
                        </div>
                    </div>
                    <!-- fila 3 -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="correou">Correo</label>
                            <input type="email" class="form-control" name="correou" id="correou" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="usuariou">Usuario</label>
                            <input type="text" class="form-control" name="usuariou" id="usuariou" required>
                        </div>

                    </div>
                    <!-- fila 4 -->
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="idRolu">Rol de usuario</label>
                            <select class="form-control form-select" name="idRolu" id="idRolu" required>
                                <option value="1">Cliente</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <!-- fila 5 -->
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="ubicacionu">Ubicación</label>
                            <textarea class="form-control" name="ubicacionu" id="ubicacionu" cols="30" rows="10" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button class="btn btn-warning" style="color: white;">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="../../public/js/usuarios/usuarios.js"></script> -->
</form>