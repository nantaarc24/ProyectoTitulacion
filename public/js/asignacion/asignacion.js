$(document).ready(function () {
    $('#tablaAsignacionesLoad').load("asignacion/tablaAsignacion.php");
    
});

function asignarEquipo() {
  $.ajax({
      type: "POST",
      data:$('#frmAsignarEquipo').serialize(),
      url:"../procesos/asignacion/asignar.php",
      success: function(respuesta) {
          // console.log(respuesta);
          respuesta= respuesta.trim();
          if (respuesta == 1) {
            $('#frmAsignarEquipo')[0].reset();
            $('#tablaAsignacionesLoad').load("asignacion/tablaAsignacion.php");
              Swal.fire(":D ","Asignado con exito","success");
          } else {
              Swal.fire(":( ","Fallo al asignar" + respuesta, "error");
              
          }
      }
  });

  return false;
}


function eliminarAsignacion(idAsignacion){

    Swal.fire({
        title: 'Estás seguro de eliminar?',
        text: "Una vez eliminado no podrá recuperar la información!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                data: "idAsignacion=" + idAsignacion,
                url:"../procesos/asignacion/eliminarAsignacion.php",
        
                success: function(respuesta) {
                    
                    respuesta= respuesta.trim();
        
                    if (respuesta == 1) {
                    
                      $('#tablaAsignacionesLoad').load("asignacion/tablaAsignacion.php");
        
                        Swal.fire(":( ","Fallo al eliminar" + respuesta, "error");
                      // Swal.fire(":D ","Eliminado con exito","success");
                    } else {
                      $('#tablaAsignacionesLoad').load("asignacion/tablaAsignacion.php");
                      // Swal.fire(":( ","Fallo al eliminar" + respuesta, "error");
                        Swal.fire(":D ","Eliminado con exito","success");
                    }
                }
            });
        }
      })
    
    return false;
}



