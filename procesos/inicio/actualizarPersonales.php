<?php
session_start();
$Usuario = $_SESSION["username"];

include '../../config.php';
//obtenemos el id_usuario por medio del usuario($_SESSION["username"])

$sql = "SELECT usuario.id_usuario as idUsuario 
FROM t_usuarios as usuario 
inner join t_persona as persona 
on usuario.id_persona = persona.id_persona 
and usuario.usuario = '$Usuario'";

$respuesta = mysqli_query($link, $sql);
$idUsuario = mysqli_fetch_array($respuesta)[0];

//fin obtenemos el id_usuario por medio del usuario($_SESSION["username"])

include '../../Inicio.php';
    $datos = array(
        'paterno'=> $_POST['paternoInicio'],
        'materno'=> $_POST['maternoInicio'],
        'nombre'=> $_POST['nombreInicio'],
        'telefono'=> $_POST['telefonoInicio'],
        'correo'=> $_POST['correoInicio'],
        'fecha'=> $_POST['fechaNacInicio'],
        'idUsuario'=> $idUsuario
    );

    echo actualizarPersonales($datos);
?>

