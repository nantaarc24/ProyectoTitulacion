<!-- VISIBLE SOLO PARA ADMINISTRADORES ID_ROL = 2 -->
<?php include 'header.php';?>

<?php
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["username"]) && $_SESSION["id"] == 2) {
    // include '../config.php';
    
?>
    <!-- Page Content -->
    <div class="container">
      <div class="card border-0 shadow my-5">
        <div class="card-body p-5">
          <h1 class="fw-light">Asignación de Equipos</h1>
          <p class="lead">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAsignarEquipo">
              Asignar equipos
            </button>
            <hr>
            <div id="tablaAsignacionesLoad"></div>
          </p>
        </div>
      </div>
    </div>

  <?php 
  include 'asignacion/modalAsignar.php';
  include 'footer.php';
  ?>

  <script src="../public/js/asignacion/asignacion.js"></script>

  <?php
  }
  else {
    header("location:../login.php");
  }
  ?>