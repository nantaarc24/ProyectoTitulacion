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
r.id_reporte AS idReporte,
r.id_usuario AS idUsuario,
CONCAT(p.paterno, ' ', p.materno, ' ', p.nombre) AS nombrePersona,
e.id_equipo AS idEquipo,
e.nombre AS nombreEquipo,
CONCAT(t.apellidos, ' ', t.nombre) AS nombreTecnico,
r.descripcion_problema AS problema,
r.estatus,
r.solucion_problema AS solucion,
a.fechaRegistro as fechaRegistro,
r.fecha,
a.garantia
FROM
t_reportes r
JOIN
t_usuarios u ON r.id_usuario = u.id_usuario
JOIN
t_persona p ON u.id_persona = p.id_persona
JOIN
t_cat_equipo e ON r.id_equipo = e.id_equipo
JOIN
t_tecnico t ON r.id_usuario_tecnico = t.id
LEFT JOIN
t_asignacion a ON r.id_equipo = a.id_equipo AND u.id_persona = a.id_persona
WHERE
r.id_usuario = '$idUsuario'
GROUP BY
r.id_reporte";

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

<script>
    function redirectToTicketPage(idReporte) {
        // Redirige a ticket.php
        window.location.href = '../ticketpdf.php?idReporte='+idReporte;
    }
</script>

<table class="table table-sm dt-responsive nowrap table-bordered" style="width: 100%;" id="tablaReportesClienteDataTable">

    <thead>
        <th>#</th>
        <th>Persona</th>
        <th>Dispositivo</th>
        <th>Técnico</th>
        <th>Garantía</th>
        <th>Fecha Reg. Producto</th>
        <th>Fecha Reg. Falla</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Solución</th>
        <th>Eliminar</th>
        <th>QR</th>
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
                <td><?php echo $mostrar['fechaRegistro']; ?></td>
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
                <td>
                    <?php if ($mostrar['solucion'] == "") { ?>
                        <!-- <button class="btn btn-primary btn-sm" onclick="generarQR(<?php echo $mostrar['idReporte']; ?>)"> -->
                        <button class="btn btn-primary btn-sm" onclick="redirectToTicketPage(<?php echo $mostrar['idReporte']; ?>)">
                            Generar QR
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

    // funcion para generar el QR
    function generarQR(idReporte) {
        // Puedes ajustar la URL según tu estructura de archivos y nombre de archivo PDF
        var pdfUrl = '../../ticketpdf/' + idReporte + '.pdf';

        // Llama a una función PHP que genera el código QR
        $.ajax({
            type: "POST",
            url: "generar_qr.php", // Crea un archivo PHP separado para generar el código QR
            data: {
                pdfUrl: pdfUrl
            },
            success: function(qrCode) {
                // Abre una nueva ventana o modal con el código QR
                // Puedes usar una biblioteca de modales como Bootstrap Modal
                alert('Código QR generado: ' + qrCode);
            }
        });
    }
</script>