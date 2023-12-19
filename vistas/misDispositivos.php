<!-- VISIBLE SOLO PARA CLIENTES ID_ROL = 1 -->
<?php
include 'header.php';


if (isset($_SESSION["username"]) && $_SESSION["id"] == 1) {

  include "../Asignacion.php";
  // include "../Usuarios.php";
  $enlace = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // $idUsuario = $_SESSION['usuario']['id'];
  $Usuario = $_SESSION["username"];

  $sql = "SELECT 
  persona.id_persona as idPersona
FROM 
  t_usuarios as usuario
inner join
  t_persona as persona on usuario.id_persona = persona.id_persona
and usuario.usuario = '$Usuario'";

  $respuesta = mysqli_query($link, $sql);

  $idPersona = mysqli_fetch_array($respuesta)[0];


  //   $respuesta = mysqli_query($link, $sql);

  //   $idPersona= mysqli_fetch_array($respuesta);

  $sql = "SELECT persona.id_persona as idPersona,
                concat(persona.paterno, 
                ' ',
                persona.materno,
                ' ',
                persona.nombre) as nombrePersona,
                equipo.id_equipo as idEquipo,
                equipo.nombre as nombreEquipo,
                asignacion.id_asignacion as idAsignacion,
                asignacion.marca AS marca,
                asignacion.modelo as modelo,
                asignacion.color as color,
                asignacion.descripcion as descripcion,
                asignacion.memoria as memoria,
                asignacion.disco_duro as discoDuro ,
                asignacion.procesador as procesador,
                equipo.descripcion as imagen
        FROM t_asignacion as asignacion 
			        inner join t_persona as persona on asignacion.id_persona = persona.id_persona
              inner join t_cat_equipo as equipo on asignacion.id_equipo = equipo.id_equipo 
              and asignacion.id_persona = '$idPersona'";

  $respuesta = mysqli_query($enlace, $sql);
?>


  <!-- Page Content -->
  <div class="container">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h1 class="fw-light">Mis dispositivos</h1>
        <p class="lead">
        <div class="row">
          <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h4>
                    <span class="<?php echo $mostrar['imagen']; ?>"></span>
                    <?php echo $mostrar['nombreEquipo']; ?>
                  </h4>
                  <p>
                    <?php echo $mostrar['descripcion']; ?>
                  </p>
                  <ul>
                    <li>Marca: <?php echo $mostrar['marca']; ?> </li>
                    <li>Modelo: <?php echo $mostrar['modelo']; ?> </li>
                    <li>Color: <?php echo $mostrar['color']; ?> </li>
                    <li>Memoria: <?php echo $mostrar['memoria']; ?> </li>
                    <li>Disco Duro: <?php echo $mostrar['discoDuro']; ?> </li>
                    <li>Procesador: <?php echo $mostrar['procesador']; ?> </li>
                  </ul>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        </p>
      </div>
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>

<?php
} else {
  header("location:../login.php");
}

?>