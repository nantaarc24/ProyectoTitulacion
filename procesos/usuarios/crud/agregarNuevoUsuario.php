<?php

print_r($_POST);
$datos = array(
    "paterno"=>$_POST['paterno'],
    "materno"=>$_POST['materno'],
    "nombre"=>$_POST['nombre'],
    "fechaNacimiento"=>$_POST['fechaNacimiento'],
    "sexo"=>$_POST['sexo'],
    "telefono"=>$_POST['telefono'],
    "correo"=>$_POST['correo'],
    "usuario"=>$_POST['usuario'],
    "password"=>password_hash($_POST['password'], PASSWORD_DEFAULT),
    "idRol"=>$_POST['idRol'],
    "ubicacion"=>$_POST['ubicacion']
);


    
include "../../../Usuarios.php";

echo agregarNuevoUsuario($datos);

?>