<!-- VISIBLE SOLO PARA ADMINISTRADORES ID_ROL = 2 -->

<?php include 'header.php'; ?>
<?php
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["username"]) && $_SESSION["id"] == 2) {


?>
  <!-- Page Content -->
  <div class="container">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h1 class="fw-light">Gestión de Reportes de Usuario</h1>
        <p class="lead">
        <div id="tablaReporteAdminLoad"></div>
        </p>
      </div>
    </div>
  </div>

<?php 
include 'reportesAdmin/modalAgregarSolucion.php';
include 'footer.php'; 
?>

<script src="../public/js/reportesAdmin/reportesAdmin.js"></script>

<?php
} else {
  header("location:../login.php");
}
?>