<?php
//capturamos el id reporte
$idReporte = $_POST['idReporte'];
include "../../Reportes.php";

echo eliminarReporteCliente($idReporte);

?>