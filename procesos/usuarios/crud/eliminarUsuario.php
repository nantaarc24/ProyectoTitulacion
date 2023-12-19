<?php
include "../../../Usuarios.php";

$datos= array(
    "idUsuario" => $_POST['idUsuario'],
    "idPersona" => $_POST['idPersona']
);


echo eliminarUsuario($datos);
?>