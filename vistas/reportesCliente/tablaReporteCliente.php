<?php
session_start();
include "../../config.php";

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
reporte.id_reporte as idReporte,
reporte.id_usuario as idUsuario,
concat(persona.paterno,
        ' ',
       persona.materno,
       ' ',
       persona.nombre) as nombrePersona,
  equipo.id_equipo as idEquipo,
  equipo.nombre as nombreEquipo,
  concat(tecnico.apellidos,' ',tecnico.nombre) as nombreTecnico,
  reporte.descripcion_problema as problema,
  reporte.estatus as estatus,
  reporte.solucion_problema as solucion,
  reporte.fecha as fecha,
  asignacion.garantia as garantia
FROM
t_reportes as reporte
INNER JOIN
t_usuarios as usuario ON reporte.id_usuario = usuario.id_usuario
INNER JOIN
t_persona as persona ON usuario.id_persona = persona.id_persona
INNER JOIN
t_cat_equipo AS equipo ON reporte.id_equipo = equipo.id_equipo
INNER JOIN
t_tecnico AS tecnico ON reporte.id_usuario_tecnico = tecnico.id
INNER JOIN
t_asignacion as asignacion ON reporte.id_equipo = asignacion.id_equipo
AND reporte.id_usuario = '$idUsuario'";

$respuesta = mysqli_query($link, $sql);
?>

<!-- posicion de las dobles flechas de la tabla -->
<style>
    .form-control-sm {
        min-height: calc(1.5em + (0.5rem + 2px));
        padding: 0.25rem 1.5rem;
        font-size: .875rem;
        border-radius: 0.2rem;
    }
</style>

<table class="table table-sm dt-responsive nowrap table-bordered" style="width: 100%;" id="tablaReportesClienteDataTable">

    <thead>
        <th>#</th>
        <th>Persona</th>
        <th>Dispositivo</th>
        <th>Técnico</th>
        <th>Garantía</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Solución</th>
        <th>Eliminar</th>
    </thead>
    <tbody>
        <?php $contador = 1; ?>
        <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
            <tr>
                <td><?php echo $contador++; ?></td>
                <td><?php echo $mostrar['nombrePersona']; ?></td>
                <td><?php echo $mostrar['nombreEquipo']; ?></td>
                <td><?php echo $mostrar['nombreTecnico']; ?></td>
                <td>
                    <?php
                    $garantia = $mostrar['garantia'];
                    echo $garantia . ($garantia == 1 ? ' mes' : ' meses');
                    ?>
                </td>
                <td><?php echo $mostrar['fecha']; ?></td>
                <td><?php echo $mostrar['problema']; ?></td>
                <td>
                    <?php
                    $estatus = $mostrar['estatus'];
                    $cadenaEstatus = '<span class="badge badge-danger">Abierto</span>';
                    if ($estatus == 0) {
                        $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';
                    }
                    echo $cadenaEstatus;
                    ?>
                </td>
                <td><?php echo $mostrar['solucion']; ?></td>
                <td>
                    <?php if ($mostrar['solucion'] == "") { ?>
                        <button class="btn btn-danger btn-sm" onclick="eliminarReporteCliente(<?php echo $mostrar['idReporte']; ?>)">
                            Eliminar
                        </button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#tablaReportesClienteDataTable').DataTable({
            language: {
                url: "../public/datatable/es_es.json",
            },
            dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf'
            // ]

            buttons: {
                buttons: [
                    // {
                    //     extend: 'copy',
                    //     className: 'btn btn-outline-info',
                    //     text: '<i class="far fa-copy"></i> Copiar'
                    // },
                    // {
                    //     extend: 'csv',
                    //     className: 'btn btn-outline-primary',
                    //     text: '<i class="fas fa-file-csv"></i> CSV'
                    // },
                    {
                        extend: 'excel',
                        className: 'btn btn-outline-success',
                        text: '<i class="fas fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-outline-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    }
                ],
                dom: {
                    button: {
                        className: 'btn'
                    }
                }
            }
        });
    });
</script>