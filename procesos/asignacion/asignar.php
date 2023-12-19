<?php

// print_r($_POST);

$datos = array(
    "idPersona" => $_POST['idPersona'],
    "idEquipo" => $_POST['idEquipo'],
    "marca" => $_POST['marca'],
    "modelo" => $_POST['modelo'],
    "color" => $_POST['color'],
    "descripcion" => $_POST['descripcion'],
    "memoria" => $_POST['memoria'],
    "discoDuro" => $_POST['discoDuro'],
    "procesador" => $_POST['procesador']
);
    
include "../../Asignacion.php";
echo agregarAsignacion($datos);
?>