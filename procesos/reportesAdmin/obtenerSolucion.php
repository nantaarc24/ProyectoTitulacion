<?php

$idReporte=$_POST['idReporte'];

include "../../Reportes.php";

echo json_encode(obtenerSolucion($idReporte));
?>