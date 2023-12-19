<?php
include '../../config.php';
session_start();
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




$datos = array(
    'idReporte'=>  $_POST['idReporte'],
    'solucion'=> $_POST['solucion'],
    'estatus'=> $_POST['estatus'],
    'idUsuario' => $idUsuario

);

include "../../Reportes.php";
echo actualizarSolucion($datos);
?>