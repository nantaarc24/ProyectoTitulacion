<?php
$idUsuario= $_POST['idUsuario'];

include "../../../Usuarios.php";
echo json_encode(obtenerDatosUsuario($idUsuario));
?>

