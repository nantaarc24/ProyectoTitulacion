$(document).ready(function () {
    $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');

})

function eliminarReporteAdmin(idReporte) {
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

  function obtenerDatosSolucion(idReporte) {
    $.ajax({
      type:"POST",
      data:"idReporte=" + idReporte,
      url:"../procesos/reportesAdmin/obtenerSolucion.php",
      success:function (respuesta) {
        respuesta=jQuery.parseJSON(respuesta);
        // console.log(respuesta);
        $('#idReporte').val(respuesta['idReporte']);
        $('#solucion').val(respuesta['solucion']);
        $('#estatus').val(respuesta['estatus']);
      }
    });

  }

  function agregarSolucionReporte() {
    $.ajax({
      type: "POST",
      data:$('#frmAgregarSolucionReporte').serialize(),
      url:"../procesos/reportesAdmin/actualizarSolucion.php",
      success:function (respuesta) {
        respuesta= respuesta.trim();
        if (respuesta == 1) {
          Swal.fire(":(", "Fallo" + respuesta, "error");
        }else{
          Swal.fire(":D", "Agregado con éxito", "success");
          $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');
          
        }
      }
    });
    return false;
  }