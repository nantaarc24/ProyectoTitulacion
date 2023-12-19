<?php

include '../../../Usuarios.php';

$datos = array(
    "password" => password_hash($_POST['passwordReset'], PASSWORD_DEFAULT),
    "idUsuario" => $_POST['idUsuarioReset']
);

echo resetPassword($datos);
?>