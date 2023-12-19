<?php
$idAsignacion= $_POST['idAsignacion'];

include "../../Asignacion.php";


echo json_encode(eliminarAsignacion($idAsignacion));
 
?>  