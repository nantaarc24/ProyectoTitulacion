function actualizarDatosPersonales() {
  $.ajax({
    type: "POST",
    data: $("#frmActualizarDatosPersonales").serialize(),
    url: "../procesos/inicio/actualizarPersonales.php",
    success: function (respuesta) {
      console.log(respuesta);
      respuesta = respuesta.trim();
      if (respuesta == 1) {
        Swal.fire(":( ", "Fallo al actualizar" + respuesta, "error");
      } else {
        
        Swal.fire(":D ", "Actualizado con exito", "success");
        location.reload();
      }
    },
  });

  return false;
}

function obtenerDatosPersonalesInicio(idUsuario) {
  $.ajax({
    type: "POST",
    data: "idUsuario=" + idUsuario,
    url: "../procesos/usuarios/crud/obtenerDatosUsuario.php",
    success: function (respuesta) {
      // console.log(respuesta);
      respuesta = jQuery.parseJSON(respuesta);
      $("#paternoInicio").val(respuesta["paterno"]);
      $("#maternoInicio").val(respuesta["materno"]);
      $("#nombreInicio").val(respuesta["nombrePersona"]);
      $("#telefonoInicio").val(respuesta["telefono"]);
      $("#correoInicio").val(respuesta["correo"]);
      $("#fechaNacInicio").val(respuesta["fechaNacimiento"]);
    },
  });
}
