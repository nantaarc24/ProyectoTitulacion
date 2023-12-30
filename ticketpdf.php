<?php

ob_start();
session_start();
include "config.php";

if (isset($_GET['idReporte'])) {
    $idReporte = $_GET['idReporte'];

    // Consulta SQL específica para obtener detalles del ticket seleccionado
    $sqlTicket = "SELECT
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
        r.id_reporte = '$idReporte'";

    $resultadoTicket = mysqli_query($link, $sqlTicket);


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalle del Ticket</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .ticket {
                max-width: 400px;
                margin: 20px auto;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .logo {
                width: 100%;
                max-height: 100px;
                margin-bottom: 20px;
                border-radius: 10px;
            }

            .ticket-title {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
                color: #333;
            }

            .info-label {
                font-weight: bold;
                color: #555;
                flex: 1;
            }

            .info-value {
                color: #333;
                flex: 2;
            }

            .info-row {
                margin-bottom: 15px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .description {
                margin-top: 20px;
                color: #444;
            }

            .header {
                text-align: center;
                font-size: 16px;
                /* background-color: #eee; */
                color: #555;
                padding: 5px;
                /* border-radius: 10px 10px 0 0; */
                margin-top: 1px;
            }
            .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        </style>
    </head>
    <?php
    // $rutaLogo = $_SERVER['DOCUMENT_ROOT'] . '/HELPDESK/images/logo.jpeg';
    // $rutaLogo = 'file:///C:/xampp/htdocs/HELPDESK/images/logo.jpeg';
    // echo $rutaLogo;
    ?>

    <body>
        <div class="ticket">

            <?php
            // Genera un código de ticket aleatorio (puedes ajustar la longitud según tus necesidades)
            $codigoTicket = strtoupper(substr(md5(uniqid()), 0, 8));
            if ($mostrarTicket = mysqli_fetch_array($resultadoTicket)) {
            ?>
                <div class="header">
                    <p>Compucenter SAC | Celular: +51 912 345 678 | Correo: info@compucenter.com</p>
                    <p>Fecha de emisión: <?php echo date('Y-m-d'); ?></p>
                </div>
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/HELPDESK/images/logo.jpeg" class="logo" alt="Logo de la empresa">

                <h2 class="ticket-title">Ticket de Garantía Compucenter</h2>

                <div class="info-row">
                    <span class="info-label">Código de Ticket:</span>
                    <span class="info-value"><?php echo strtoupper(substr(md5(uniqid()), 0, 8)); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Cliente:</span>
                    <span class="info-value"><?php echo $mostrarTicket['nombrePersona']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Producto:</span>
                    <span class="info-value"><?php echo $mostrarTicket['nombreEquipo']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Técnico:</span>
                    <span class="info-value"><?php echo $mostrarTicket['nombreTecnico']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Garantía:</span>
                    <span class="info-value">
                        <?php
                        $garantia = $mostrarTicket['garantia'];
                        echo $garantia . ($garantia == 1 ? ' mes' : ' meses');
                        ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha Reg. Producto:</span>
                    <span class="info-value"><?php echo $mostrarTicket['fechaRegistro']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha Reg. Falla:</span>
                    <span class="info-value"><?php echo $mostrarTicket['fecha']; ?></span>
                </div>
                <div class="info-row description">
                    <span class="info-label">Descripción:</span>
                    <span class="info-value"><?php echo $mostrarTicket['problema']; ?></span>
                </div>
        <?php
            } else {
                // Manejar el caso en que no se encuentra el ticket
                echo "Ticket no encontrado";
            }
        } else {
            // Manejar el caso en que no se proporcionó el idReporte en la URL
            echo "Parámetro idReporte no proporcionado";
        }

        ?>
        <div class="footer">
            <p>Este ticket es válido por 7 días. Todos los derechos reservados &copy; Compucenter SAC</p>
        </div>
        </div>
        </div>

    </body>

    </html>
    <?php
    $html = ob_get_clean();
    // echo $html;

    // require 'vendor/autoload.php';
    require_once 'dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    // $dompdf->setPaper('A4','landscape');

    $dompdf->render();
    $dompdf->stream("archivo_.pdf", array("Attachment" => false));

    ?>