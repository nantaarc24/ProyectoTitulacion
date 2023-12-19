function datosPersonalesInicio(idUsuario) {
    $.ajax({
        type:"POST",
        data:"idUsuario=" + idUsuario,
        url:"../procesos/usuarios/crud/obtenerDatosUsuario.php",
        success:function (respuesta) {
            // console.log(respuesta);
            respuesta= jQuery.parseJSON(respuesta);
            $('#paterno').text(respuesta['paterno']);
            $('#materno').text(respuesta['materno']);
            $('#nombre').text(respuesta['nombrePersona']);
            $('#telefono').text(respuesta['telefono']);
            $('#correo').text(respuesta['correo']);
            $('#fechNac').text(respuesta['fechaNacimiento']);
        }
    })
}