<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function agregarAsignacion($datos){

                $sql= "INSERT INTO t_asignacion(id_persona,
                                                id_equipo,
                                                marca,
                                                modelo,
                                                color,
                                                descripcion,
                                                memoria,
                                                disco_duro,
                                                procesador)
                        VALUES (?,?,?,?,?,?,?,?,?)";
                $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $query= $enlace->prepare($sql);
                $query->bind_param("iisssssss", $datos["idPersona"],
                                                $datos["idEquipo"],
                                                $datos["marca"],
                                                $datos["modelo"],
                                                $datos["color"],
                                                $datos["descripcion"],
                                                $datos["memoria"],
                                                $datos["discoDuro"],
                                                $datos["procesador"]);
                
                $respuesta = $query->execute();
                // $query->close();
                return $respuesta;                            
            }


            function eliminarAsignacion($idAsignacion){

                $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            

                 $sql= "DELETE FROM t_asignacion 
                        WHERE id_asignacion= ?";

                $query= $enlace->prepare($sql);
                
                $query->bind_param('i', $idAsignacion);

                $respuesta= $query->execute();
                $query->close();
                return $respuesta;   


        }

        function seleccionarIdPersona($idPersona){
            $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $sql = "SELECT * FROM t_persona WHERE id_persona = '$idPersona'";

            $respuesta=mysqli_query($enlace,$sql);
            $usuario=mysqli_fetch_array($respuesta);

            $datos = array(
                'idPersona' => $usuario['idPersona']
            );

            return $datos;
        }
    }
?>


         
         