<?php
session_start();
include '../config.php';
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="../public/css/plantilla.css" />
    <link rel="stylesheet" href="../public/datatable/dataTables.bootstrap4.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../public/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../public/fontawesome/css/all.css">
    <link rel="stylesheet" href="../public/datatable/buttons.dataTables.min.css">
    <link rel="shortcut icon" href="../images/icono.jpeg" style="height: 130px; width: 130px;">
    <title>Soporte Técnio Help-Desk</title>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light static-top mb-5 shadow">
        <div class="container">
            <a class="navbar-brand" href="inicio.php">
                <img src="../public/img/hdlogo.png" width="50px" height="50px" alt="">
                Help-Desk
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicio.php">
                            <span class="fas fa-home"></span> Inicio</a>
                    </li>

                    <?php if ($_SESSION["id"] == 1) {  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="misDispositivos.php">
                                <span class="fas fa-microchip"></span> Mis dispositivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="misReportes.php">
                                <span class="fas fa-file-alt"></span> Reportes de Soporte</a>
                        </li>
                    <?php } ?>
                    <!-- DESDE AQUI INICIA LAS VISTAS DEL USUARIO ADMINISTRADOR -->

                    <?php if ($_SESSION["id"] == 2) {  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php">
                                <span class="fas fa-user-tie"></span> Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="asignacion.php">
                                <span class="fas fa-address-book"></span> Asignación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reportes.php">
                            <span class="fas fa-file-alt"></span> Reportes</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item dropdown">
                        <a style="color:red;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-user-ninja"></span> Usuario: <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"
                            data-bs-toggle="modal" data-bs-target="#modalActualizarDatosPersonales"
                            onclick="obtenerDatosPersonalesInicio('<?php echo $idUsuario; ?>')"
                            >
                            <span class="fas fa-user-edit"></span> Editar Datos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../procesos/usuarios/login/salir.php">
                                <span class="fas fa-sign-out-alt"></span> Salir</a>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
<?php include 'inicio/modalActualizarDatosPersonales.php'; ?>
