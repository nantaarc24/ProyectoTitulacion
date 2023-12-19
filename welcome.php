<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// Verifique si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:vistas/inicio.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenid@ a nuestra central de soporte.</h1>
        
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Cambia tu contraseña</a>
        <a href="logout.php" class="btn btn-danger">Cierra la sesión</a>
        <!-- <br><br><h2>Clic en el logo para más tips <a href="https://www.configuroweb.com/desarrollo/"><img src="images/configuroweb.png" width="170"></a> -->
        <!-- <br><br><iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLEp4kajrb4a0fgy8e5JO3iGO7iKnPwQFQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
    </p>


</body>
</html>