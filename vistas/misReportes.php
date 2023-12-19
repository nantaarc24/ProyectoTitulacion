<!-- VISIBLE SOLO PARA CLIENTES ID_ROL = 1 -->

<?php include 'header.php'; ?>
<?php
// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["username"]) && $_SESSION["id"] == 1) {
// include '../config.php';

?>
  <!-- Page Content -->
  <div class="container">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h1 class="fw-light">Reportes de Cliente</h1>
        <p class="lead">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearReporte">
            Crear Reporte
          </button>
          <hr>

        <div id="tablaReporteClienteLoad"></div>

        </p>

      </div>
    </div>
  </div>
  <?php
  include "reportesCliente/modalCrearReporte.php";
  include 'footer.php';

  ?>

  <script src="../public/js/reportesClientes/reportesCliente.js"> </script>
<?php
} else {
  header("location:../login.php");
}
?>