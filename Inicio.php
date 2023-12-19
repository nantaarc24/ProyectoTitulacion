<?php
include 'config.php';

function actualizarPersonales($datos){
    $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//     $idUsuario= $datos['idUsuario'];
//     $sql= "SELECT id_persona FROM t_usuarios WHERE id_usuario = '$idUsuario'";
//     $respuesta= mysqli_query($enlace, $sql);
//     $idPersona= mysqli_fetch_row($respuesta)[0];

echo $idPersona= obtenerIdPersona($datos['idUsuario']);

    $sql="UPDATE t_persona
          SET
                paterno= ?,
                materno= ?,
                nombre= ?,
                telefono= ?,
                correo= ?,
                fecha_nacimiento= ?
          WHERE
                id_persona= ?";
    $query= $enlace->prepare($sql);
    $query->bind_param("ssssssi", $datos['paterno'],
                                  $datos['materno'],
                                  $datos['nombre'],
                                  $datos['telefono'],
                                  $datos['correo'],
                                  $datos['fecha'],
                                  obtenerIdPersona($datos['idUsuario']));
    $respuesta= $query->execute();

    return $respuesta;
}

function obtenerIdPersona($idUsuario){
      $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      $sql= "SELECT 
              persona.id_persona AS idPersona
              FROM
                  t_usuarios AS usuarios
                  INNER JOIN
                  t_persona AS persona ON usuarios.id_persona = persona.id_persona
                  AND usuarios.id_usuario = '$idUsuario'";

      $respuesta= mysqli_query($enlace, $sql);
      $idPersona= mysqli_fetch_array($respuesta)['idPersona'];

      return $idPersona;
  }
?>