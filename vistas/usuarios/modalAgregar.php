<!-- Modal -->
<!-- <script src="../../public/js/usuarios/usuarios.js"></script> -->
<form id="frmAgregarUsuario" method="POST" onsubmit="return agregarNuevoUsuario()">
    <div class="modal fade" id="modalAgregarUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- fila 1 -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="paterno">Apellido Paterno</label>
                            <input type="text" class="form-control" name="paterno" required id="paterno">
                        </div>

                        <div class="col-sm-4">
                            <label for="materno">Apellido Materno</label>
                            <input type="text" class="form-control" name="materno" required id="materno">
                        </div>

                        <div class="col-sm-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required id="nombre">
                        </div>
                    </div>
                    <!-- fila 2 -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="sexo">Sexo</label>
                            <select class="form-control form-select" name="sexo" id="sexo" required>
                                <option value=""></option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" required>
                        </div>
                    </div>
                    <!-- fila 3 -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" name="correo" id="correo" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="password">Contraseña</label>
                            <input type="text" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <!-- fila 4 -->
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="idRol">Rol de usuario</label>
                            <select class="form-control form-select" name="idRol" id="idRol" required>
                                <option value="1">Cliente</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <!-- fila 5 -->
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="ubicacion">Ubicación</label>
                            <textarea class="form-control" name="ubicacion" id="ubicacion" cols="30" rows="10" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</span>
                    <button class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>

</form>
<!-- <script src="../../public/js/usuarios/usuarios.js"></script> -->