<?php
include 'config.php';


function agregarReporteCliente($datos){
    $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    $sql= "INSERT INTO t_reportes (id_usuario, id_equipo,id_usuario_tecnico,descripcion_problema) VALUES (?,?,?,?)";

    
    $query= $enlace->prepare($sql);
    $query->bind_param('iiis', $datos['idUsuario'],
                              $datos['idEquipo'],
                              $datos['idTecnico'],
                              $datos['problema']);
    $respuesta=$query->execute();
    // $query->close();
    // $respuesta=mysqli_stmt_execute($query);
    return $respuesta;

}

function eliminarReporteCliente($idReporte){
    

    $sql= "DELETE FROM t_reportes WHERE id_reporte = ?";
    $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $query= $enlace->prepare($sql);
    $query->bind_param('i', $idReporte);
    $respuesta= $query->execute();
    // $query->close();

    return $respuesta;
}

function obtenerSolucion($idReporte){
    $sql="SELECT solucion_problema,estatus
          FROM t_reportes
          WHERE id_reporte = '$idReporte'";
    
    $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $respuesta=mysqli_query($enlace, $sql);
    // $reporte=mysqli_fetch_assoc($respuesta);
    $reporte=mysqli_fetch_array($respuesta);
        $datos = array(
            "idReporte" => $idReporte,
            "estatus" => $reporte['estatus'],
            "solucion" => $reporte['solucion_problema']
        );
    
    // print_r('-.-'.$datos);
    //implode para solucionar el tema de convert string to array
    //return implode($datos);
    return $datos;
}

function actualizarSolucion($datos){
    $sql="UPDATE t_reportes
          SET 
              solucion_problema= ?,
              estatus= ?
          WHERE id_reporte= ?";
    $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $query= $enlace->prepare($sql);
    $query->bind_param('sii', 
                               $datos['solucion'],
                               $datos['estatus'],
                               $datos['idReporte']);
    $respuesta= $query->execute();
    return $respuesta;                                
}
?>