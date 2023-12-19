<?php include 'header.php'; ?>
<?php
// session_start();
// include "../config.php";

$Usuario = $_SESSION["username"];

if (isset($_SESSION["username"]) && $_SESSION["id"] == 1 || $_SESSION["id"] == 2) {
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


  <!-- Page Content -->

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="../public/css/Inicio.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.css"> -->

    <style type="text/css">
      body {
        font: 15px sans-serif;
        /* text-align: center; */
      }
    </style>
  </head>

  <body>
    <h1 style="text-align: center; color: white;" class="fw-light">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido(a) a nuestra central de soporte.</h1>
    <div class="box">
      <div class="container">
        <div class="row">



          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="box-part text-center">

              
              <img src="../images/usuario.jpeg" alt="" style="width: 100px; height: 100px; margin-bottom: 25px;">
              
              <div class="title">
              
                <h4><b>Datos del Usuario</b></h4>
              </div>
              

              <p class="lead">
              <div class="row">
                <div class="col-sm-4">Apellido Paterno: <span id="paterno"></span></div>
                <div class="col-sm-4">Apellido Materno: <span id="materno"></span></div>
                <div class="col-sm-4">Nombre: <span id="nombre"></span></div>
              </div>

              <div class="row">
                <div class="col-sm-4">Teléfono: <span id="telefono"></span></div>
                <div class="col-sm-4">Correo: <span id="correo"></span></div>
                <div class="col-sm-4">Fecha de Nacimiento: <span id="fechNac"></span></div>
              </div>
              </p>



            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

            <div class="box-part text-center">

          

              <img src="../images/proteger.jpeg" alt="" style="width: 50px; height: 50px; margin-bottom: 25px;">

              <div class="title">
                <h4><b>Confianza y Seguridad</b></h4>
              </div>

              <div class="text">
                <p>Proporciona acceso remoto, soporte remoto y capacidades de colaboración en línea con un nivel de seguridad y privacidad necesarios para que las organizaciones mantengan su cumplimiento con HIPAA.</p>
              </div>



            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

            <div class="box-part text-center">

            <img src="../images/acerca-de.jpeg" alt="" style="width: 50px; height: 50px; margin-bottom: 25px;">

          

              <div class="title">
                <h4><b>Quienes Somos</b></h4>
              </div>

              <div class="text">
              <p>Nos dedicamos a optimizar las inversiones de nuestros clientes en Recursos Humanos, Tecnología de Información y Relaciones con Clientes.Nuestras soluciones están enfocadas a Tecnología de Información, Administración y Desarrollo del Talento, Colaboración, Productividad y Lealtad.</p>
     
              </div>



            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

            <div class="box-part text-center">

            <img src="../images/herramientas.jpeg" alt="" style="width: 50px; height: 50px; margin-bottom: 25px;">

              <div class="title">
                <h4><b>Soluciones Integrales</b></h4>
              </div>

              <div class="text">
              <p>Desde el primer día que iniciamos operaciones nos convertimos en un aliado de su empresa. Hacemos nuestros sus objetivos con la finalidad de apoyarlo en el cumplimiento de los mismos desde nuestro rol en el soporte técnico de su plataforma de cómputo.</p>
      
              </div>



            </div>
          </div>

        </div>
      </div>
    </div>

  </body>

  </html>



  <?php include 'footer.php'; ?>

  <script src="../public/js/inicio/personales.js"></script>
  <script>
    let idUsuario = '<?php echo $idUsuario; ?>';
    datosPersonalesInicio(idUsuario);
  </script>
<?php
} else {
  header("location:../login.php");
}
?>