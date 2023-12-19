<?php
session_start();
include '../../config.php';
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
    'idUsuario' => $idUsuario,
    'idEquipo'=> $_POST['idEquipo'],
    'problema'=> $_POST['problema']
    
);

// echo '-'.$datos['idUsuario'].'-';
// echo '-'.$datos['idEquipo'].'-';
// echo '-'.$datos['problema'].'-';

include "../../Reportes.php";

echo agregarReporteCliente($datos);

?>