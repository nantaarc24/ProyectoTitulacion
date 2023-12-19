 jQuery('#go').on('click',
 function loginUsuario(){
  
    var dataToSend = $(this).serialize();
    $.ajax({
        type:"POST",
        data:dataToSend,
           
            
        url:"procesos/usuarios/login/loginUsuario.php",
        success:function(respuesta){
            respuesta=respuesta.trim();

            if (respuesta==1){
                window.location.href = "vistas/inicio.php";
                console.log('hemos podido conectarnos');
            } else{
                Swal.fire(":(", "Error al entrar" + respuesta, "error");
            }
        }
    });
    
    return false;
});