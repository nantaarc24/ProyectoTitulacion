$(document).ready(function () {
  $("#tablaUsuariosLoad").load("usuarios/tablaUsuarios.php");
});

function agregarNuevoUsuario() {
  $.ajax({
    type: "POST",
    data: $("#frmAgregarUsuario").serialize(),
    url: "../procesos/usuarios/crud/agregarNuevoUsuario.php",
    success: function (respuesta) {
      // console.log(respuesta);
      respuesta = respuesta.trim();
      if (respuesta == 1) {
        // cargar la pagina para que se muestre en la tb el usuario registrado
        //$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
        //limpiamos el formulario
        //$('#frmAgregarUsuario')[0].reset();
        //Swal.fire(":D","Se registró el usuario correctamente.","success");
        Swal.fire(
          ":(",
          " No se pudo registrar el usuario. " + respuesta,
          "error"
        );
      } else {
        // cargar la pagina para que se muestre en la tb el usuario registrado
        $("#tablaUsuariosLoad").load("usuarios/tablaUsuarios.php");
        //limpiamos el formulario
        $("#frmAgregarUsuario")[0].reset();

        Swal.fire(":D", "Se registró el usuario correctamente.", "success");
      }
    },
  });

  return false;
}

function obtenerDatosUsuario(idUsuario) {
  $.ajax({
    type: "POST",
    data: "idUsuario=" + idUsuario,
    url: "../procesos/usuarios/crud/obtenerDatosUsuario.php",
    success: function (respuesta) {
      respuesta = jQuery.parseJSON(respuesta);
      //console.log(respuesta);
      $("#idUsuario").val(respuesta["idUsuario"]);
      $("#paternou").val(respuesta["paterno"]);
      $("#maternou").val(respuesta["materno"]);
      $("#nombreu").val(respuesta["nombrePersona"]);
      $("#fechaNacimientou").val(respuesta["fechaNacimiento"]);
      $("#sexou").val(respuesta["sexo"]);
      $("#telefonou").val(respuesta["telefono"]);
      $("#correou").val(respuesta["correo"]);
      $("#usuariou").val(respuesta["nombreUsuario"]);
      $("#idRolu").val(respuesta["idRol"]);
      $("#ubicacionu").val(respuesta["ubicacion"]);
    },
  });
  //alert(idUsuario);
}

function actualizarUsuario() {
  $.ajax({
    type: "POST",
    data: $("#frmActualizarUsuario").serialize(),
    url: "../procesos/usuarios/crud/actualizarUsuario.php",
    success: function (respuesta) {
      // console.log(respuesta);
      respuesta = respuesta.trim();
      if (respuesta == 1) {
        // cargar la pagina para que se muestre en la tb el usuario registrado
        $("#tablaUsuariosLoad").load("usuarios/tablaUsuarios.php");
        $("#modalActualizarUsuarios").modal("hide");
        //limpiamos el formulario

        Swal.fire(":D", "Se actualizó el usuario correctamente.", "success");
      } else {
        Swal.fire(
          ":(",
          " No se pudo actualizar el usuario. " + respuesta,
          "error"
        );
      }
    },
  });
  return false;
}

function agregarIdUsuarioReset(idUsuario) {
  $("#idUsuarioReset").val(idUsuario);
}

function resetPassword() {
  $.ajax({
    type: "POST",
    data: $("#frmActualizaPassword").serialize(),
    url: "../procesos/usuarios/extras/resetPassword.php",
    success: function (respuesta) {
      // console.log(respuesta);
      respuesta = respuesta.trim();
      if (respuesta == 1) {
        // $('#modalResetPassword').modal('hide');
        // $('#modalResetPassword').remove();
        $("[data-dismiss=modal]").trigger({ type: "click" });
        // $('#modalResetPassword')[0].reset();
        Swal.fire(":D", "Se actualizó la clave correctamente.", "success");
      } else {
        Swal.fire(
          ":(",
          " No se pudo actualizar la clave. " + respuesta,
          "error"
        );
      }
    },
  });
  return false;
}

function cambioEstatusUsuario(idUsuario, estatus) {
  $.ajax({
    type: "POST",
    data: "idUsuario=" + idUsuario + "&estatus= " + estatus,
    url: "../procesos/usuarios/extras/cambioEstatus.php",
    success: function (respuesta) {
      respuesta = respuesta.trim();
      if (respuesta == 1) {
        $("#tablaUsuariosLoad").load("usuarios/tablaUsuarios.php");
        Swal.fire(":D", "Cambio de estatus exitoso.", "success");
      } else {
        Swal.fire(
          ":(",
          " No se pudo cambiar el estatus. " + respuesta,
          "error"
        );
      }
    },
  });
}

function eliminarUsuario(idUsuario, idPersona) {
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
        data: "idUsuario=" + idUsuario + "&idPersona=" + idPersona,
        url: "../procesos/usuarios/crud/eliminarUsuario.php",
        success: function (respuesta) {
          respuesta = respuesta.trim();
          if (respuesta == 1) {
            $("#tablaUsuariosLoad").load("usuarios/tablaUsuarios.php");
            Swal.fire(":D", "El usuario a sido eliminado.", "success");
          } else {
            Swal.fire(
              ":(",
              " No se pudo eliminar al usuario. " + respuesta,
              "error"
            );
          }
        },
      });
    }
  });
  return false;
}
