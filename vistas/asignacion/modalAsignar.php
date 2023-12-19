<!-- Modal -->
<form id="frmAsignarEquipo" method="post" onsubmit="return asignarEquipo()">

    <div class="modal fade" id="modalAsignarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Asignar Equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <label>Nombre de persona</label>
                            <?php
                            // $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                            $sql = "SELECT persona.id_persona, concat(persona.paterno,' ',persona.materno,' ',persona.nombre) AS nombre
                                    FROM t_persona AS persona
                                    INNER JOIN t_usuarios AS usuario ON persona.id_persona = usuario.id_persona
                                    AND usuario.id_rol = 1
                                    ORDER BY persona.paterno;";
                                    //se cambió peerosna
                            $respuesta = mysqli_query($link, $sql);

                            ?>
                            <select name="idPersona" id="idPersona" class="form-control form-select" required>
                                <option value="">Seleccione una opción</option>
                                <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                    <option value="<?php echo $mostrar['id_persona']; ?>"><?php echo $mostrar['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label>Tipo de equipo</label>
                            <?php
                            $sql = "SELECT id_equipo, nombre FROM t_cat_equipo ORDER BY nombre";
                            $respuesta = mysqli_query($link, $sql);
                            ?>
                            <select name="idEquipo" id="idEquipo" class="form-control form-select" required>
                                <option value="">Seleccione una opción</option>
                                <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                    <option value="<?php echo $mostrar['id_equipo']; ?>"> <?php echo $mostrar['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="marca">Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" required>
                        </div>

                        <div class="col-sm-4">
                            <label for="color">Color</label>
                            <input type="text" name="color" id="color" class="form-control" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="memoria">Memoria</label>
                            <input type="text" class="form-control" name="memoria" id="memoria" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="discoDuro">Disco Duro</label>
                            <input type="text" class="form-control" name="discoDuro" id="discoDuro" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="procesador">Procesador</label>
                            <input type="text" class="form-control" name="procesador" id="procesador" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Asignar</button>
                </div>
            </div>
        </div>
    </div>
</form>