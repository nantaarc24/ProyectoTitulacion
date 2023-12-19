<?php

include '../../../Usuarios.php';
session_start();

// $Usuario = $_SESSION["username"];
$idUsuario=$_POST['idUsuario'];
$estatus= $_POST['estatus'];


//obtenemos el id_usuario por medio del usuario($_SESSION["username"])

// $sql2 = "SELECT usuario.id_usuario as idUsuario 
// FROM t_usuarios as usuario 
// inner join t_persona as persona 
// on usuario.id_persona = persona.id_persona 
// and usuario.usuario = '$Usuario'";

// $respuesta2 = mysqli_query($link, $sql2);
// $idUsuario = mysqli_fetch_array($respuesta2)[0];

//fin obtenemos el id_usuario por medio del usuario($_SESSION["username"])

echo cambioEstatusUsuario($idUsuario, $estatus);
?>