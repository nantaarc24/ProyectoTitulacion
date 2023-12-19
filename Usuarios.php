
<?php
require_once "config.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    function agregarNuevoUsuario($datos)
    {

        $idPersona = agregarPersona($datos);

        if ($idPersona > 0) {
            $sql = "INSERT INTO t_usuarios(id_rol, id_persona, usuario, password, ubicacion)
                   VALUES (?,?,?,?,?)";
            // no tocar el $enlace
            $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $query = mysqli_prepare($enlace, $sql);
            mysqli_stmt_bind_param(
                $query,
                "iisss",
                $datos["idRol"],
                $idPersona,
                $datos["usuario"],
                $datos["password"],
                $datos["ubicacion"]
            );
            //$respuesta= $query->execute();
            $respuesta = mysqli_stmt_execute($query);


            return $respuesta;
        } else {
            return 0;
        }
    }


    function agregarPersona($datos)
    {

        $sql = "INSERT INTO t_persona (
                                    paterno,
                                    materno,
                                    nombre,
                                    fecha_nacimiento,
                                    sexo,
                                    telefono,
                                    correo
                                    )
                VALUES (?,?,?,?,?,?,?)";
        // no tocar el $enlace
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $query = mysqli_prepare($enlace, $sql);
        mysqli_stmt_bind_param(
            $query,
            "sssssss",
            $datos["paterno"],
            $datos["materno"],
            $datos["nombre"],
            $datos["fechaNacimiento"],
            $datos["sexo"],
            $datos["telefono"],
            $datos["correo"]
        );
        //$respuesta = $query->execute();


        mysqli_stmt_execute($query);
        $idPersona = mysqli_insert_id($enlace);
        //$idPersona= $query->insert_id;
    
        echo $idPersona . '-. ';
        return $idPersona;
    }

    function obtenerDatosUsuario($idUsuario)
    {
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $sql="SELECT usuarios.id_usuario as idUsuario, 
                usuarios.usuario as nombreUsuario, 
                roles.nombre as rol, 
                usuarios.id_rol as idRol, 
                usuarios.ubicacion as ubicacion, 
                usuarios.activo as estatus, 
                usuarios.id_persona as idPersona, 
                persona.nombre as nombrePersona, 
                persona.paterno as paterno, 
                persona.materno as materno, 
                persona.fecha_nacimiento as fechaNacimiento, 
                persona.sexo as sexo, 
                persona.correo as correo, 
                persona.telefono as telefono 
            FROM `t_usuarios` AS usuarios 
                INNER JOIN t_cat_roles as roles 
                ON usuarios.id_rol = roles.id_rol 
                INNER JOIN t_persona as persona 
                ON usuarios.id_persona = persona.id_persona AND usuarios.id_usuario = '$idUsuario'";

            $respuesta = mysqli_query($enlace, $sql);
            $usuario= mysqli_fetch_array($respuesta);

            $datos = array(

                 'idUsuario'=>$usuario['idUsuario'], 
                 'nombreUsuario'=>$usuario['nombreUsuario'], 
                 'rol'=>$usuario['rol'], 
                 'idRol'=>$usuario['idRol'], 
                 'ubicacion'=>$usuario['ubicacion'], 
                 'estatus'=>$usuario['estatus'], 
                 'idPersona'=>$usuario['idPersona'], 
                 'nombrePersona'=>$usuario['nombrePersona'], 
                 'paterno'=>$usuario['paterno'], 
                 'materno'=>$usuario['materno'], 
                 'fechaNacimiento'=>$usuario['fechaNacimiento'], 
                 'sexo'=>$usuario['sexo'], 
                 'correo'=>$usuario['correo'], 
                 'telefono'=>$usuario['telefono'] 
            );


        return $datos;
    }

    function actualizarUsuario($datos){
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $exitoPersona= actualizarPersona($datos);

        if ($exitoPersona) {
            $sql= "UPDATE t_usuarios SET id_rol= ?,
                                         usuario= ?,
                                         ubicacion= ?
                    WHERE id_usuario= ?";
            $query= $enlace->prepare($sql);
            $query->bind_param('issi', $datos['idRol'],
                                       $datos['usuario'],
                                       $datos['ubicacion'],
                                       $datos['idUsuario']);
            $respuesta= $query->execute();
            $query->close();
            return $respuesta;
        } else {
            return 0;
        }
        
    }

    function actualizarPersona($datos){
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $idPersona= obtenerIdPersona($datos['idUsuario']);

        $sql = "UPDATE t_persona SET paterno= ?,
                                     materno= ?,
                                     nombre= ?,
                                     fecha_nacimiento= ?,
                                     sexo= ?,
                                     telefono= ?,
                                     correo= ?
                WHERE id_persona= ?";
            $query= $enlace->prepare($sql);
            $query->bind_param('sssssssi', $datos['paterno'],
                                           $datos['materno'],
                                           $datos['nombre'],
                                           $datos['fechaNacimiento'],
                                           $datos['sexo'],
                                           $datos['telefono'],
                                           $datos['correo'],
                                           $idPersona);
    
            $respuesta= $query->execute();
            $query->close();
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

    function resetPassword($datos){
        $sql="UPDATE t_usuarios
              SET password= ?
              WHERE id_usuario= ?";
        
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $query= $enlace->prepare($sql);
        $query->bind_param('si', $datos['password'],
                                 $datos['idUsuario']);
        $respuesta= $query->execute();

        return $respuesta;
    }

    function cambioEstatusUsuario($idUsuario, $estatus){
        if ($estatus == 1) {
            $estatus = 0;
        } else{
            $estatus = 1;
        }

        $sql= "UPDATE t_usuarios
               SET activo= ?
               WHERE id_usuario= ?";
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $query= $enlace->prepare($sql);
        // echo $estatus;
        $query->bind_param('ii', $estatus, $idUsuario);
        $respuesta= $query->execute();

        return $respuesta;
        
    }

    function buscarReportesUsuario($idUsuario){

        $sql= "SELECT * FROM t_reportes WHERE id_usuario = '$idUsuario'";
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $respuesta= mysqli_query($enlace, $sql);

        if (mysqli_num_rows($respuesta) > 0) {
            return 1;
        } else {
            return 0;
        }
        
    }

    function buscarAsignacionPersona($idPersona){

        $sql= "SELECT * FROM t_asignacion WHERE id_persona = '$idPersona'";
        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $respuesta= mysqli_query($enlace, $sql);

        if (mysqli_num_rows($respuesta) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function eliminarUsuario($datos){

        $reportes= buscarReportesUsuario($datos['idUsuario']);
        $asignaciones= buscarAsignacionPersona($datos['idPersona']);

        $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($reportes == 0 && $asignaciones == 0) {
            # eliminamos un usuario
            $sql= "DELETE FROM t_usuarios WHERE id_usuario = ?";
            $query= $enlace->prepare($sql);
            $query->bind_param('i', $datos['idUsuario']);
            $respuesta= $query->execute();
            return $respuesta;
        } else {
            return 0;
        }
        
    }
}


?>