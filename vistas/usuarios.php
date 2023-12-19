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
        <h1 class="fw-light">Administrar Usuarios</h1>
        <p class="lead">
          <!-- Button trigger modal -->
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuarios">
            Agregar Usuario
          </button>
          <hr>
        <div id="tablaUsuariosLoad"></div>
        </p>
      </div>
    </div>
  </div>

<?php
  include("usuarios/modalAgregar.php");
  include("usuarios/modalActualizar.php");
  include("usuarios/modalResetPassword.php");
  include 'footer.php';
?>
<?php
} else {
  header("location:../login.php");
}
?>

