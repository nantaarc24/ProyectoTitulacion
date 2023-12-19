<!-- Modal -->
<form id="frmNuevoReporte" method="POST" onsubmit="return agregarNuevoReporte()">
  <div class="modal fade" id="modalCrearReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Reporte</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <label for="idEquipo">Mis dispositivos</label>
          <?php

          $Usuario = $_SESSION["username"];
          //obtenemos el id_usuario por medio del usuario($_SESSION["username"])

          $sql = "SELECT usuario.id_usuario as idUsuario 
                  FROM t_usuarios as usuario 
                  inner join t_persona as persona 
                  on usuario.id_persona = persona.id_persona 
                  and usuario.usuario = '$Usuario'";

          $respuesta = mysqli_query($link, $sql);
          $idUsuario = mysqli_fetch_array($respuesta)[0];

          //fin obtenemos el id_usuario por medio del usuario($_SESSION["username"])


          $sql = "SELECT
                        asignacion.id_asignacion as idAsignacion,
                        equipo.id_equipo as idEquipo,
                        equipo.nombre as nombreEquipo
                  FROM
                        t_asignacion AS asignacion
                        INNER JOIN
                        t_cat_equipo AS equipo ON asignacion.id_equipo = equipo.id_equipo
                  WHERE
                        asignacion.id_persona =(SELECT
                                                    id_persona
                                                    FROM
                                                    t_usuarios
                                                    WHERE
                                                    id_usuario = '$idUsuario')";
          
          $respuesta= mysqli_query($link, $sql);
          ?>

          <select name="idEquipo" id="idEquipo" class="form-control form-select">
            <option value="">Selecciona un dispositivo</option>
            <?php while($mostrar = mysqli_fetch_array($respuesta)){ ?>
              <option value="<?php echo $mostrar['idEquipo']; ?>"> <?php echo $mostrar['nombreEquipo']; ?> </option>
            <?php } ?>
          </select>

          <label for="problema">Describe tu problema</label>
          <textarea name="problema" id="problema" class="form-control"></textarea>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary">Crear</button>
        </div>
      </div>
    </div>
  </div>

</form>

<?php //include '../../procesos/reportesCliente/agregarNuevoReporte.php'; ?>