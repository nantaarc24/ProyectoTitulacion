$(document).ready(function () {
  $("#tablaReporteClienteLoad").load("reportesCliente/tablaReporteCliente.php");
});

function agregarNuevoReporte() {
  $.ajax({
    type: "POST",
    data: $("#frmNuevoReporte").serialize(),
    url: "../procesos/reportesCliente/agregarNuevoReporte.php",
    success: function (respuesta) {
      respuesta = respuesta.trim();
      if (respuesta == 1) {
        $("#tablaReporteClienteLoad").load(
          "reportesCliente/tablaReporteCliente.php"
        );
        //limpiamos el formulario
        $("#frmNuevoReporte")[0].reset();
        Swal.fire(
          ":(",
          " No se pudo registrar el reporte. " + respuesta,
          "error"
        );
      } else {
        // cargar la pagina para que se muestre en la tb el usuario registrado
        $("#tablaReporteClienteLoad").load(
          "reportesCliente/tablaReporteCliente.php"
        );
        //limpiamos el formulario
        $("#frmNuevoReporte")[0].reset();
        Swal.fire(":D", "Se registró el reporte correctamente.", "success");
      }
    },
  });

  return false;
}

function eliminarReporteCliente(idReporte) {
  Swal.fire({
    title: "Estás seguro de eliminar?",
    text: "Una vez eliminado no podrá recuperar la información!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        data: "idReporte=" + idReporte,
        url: "../procesos/reportesCliente/eliminarReporteCliente.php",

        success: function (respuesta) {
          respuesta = respuesta.trim();

          if (respuesta == 1) {
            $("#tablaReporteClienteLoad").load(
              "reportesCliente/tablaReporteCliente.php"
            );

            //Swal.fire(":( ","Fallo al eliminar" + respuesta, "error");
            Swal.fire(":D ", "Eliminado con exito", "success");
          } else {
            Swal.fire(":( ", "Fallo al eliminar" + respuesta, "error");
          }
        },
      });
    }
  });

  return false;
}
