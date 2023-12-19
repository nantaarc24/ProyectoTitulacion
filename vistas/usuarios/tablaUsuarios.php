<?php
include '../../config.php';
$sql = "SELECT usuarios.id_usuario as idUsuario, 
                usuarios.usuario as nombreUsuario, 
                roles.nombre as rol, 
                usuarios.id_rol as idRol, 
                usuarios.ubicacion as ubicacion, 
                usuarios.activo as estatus, 
                usuarios.id_persona as idPersona, 
                persona.nombre as nombrePersona, 
                persona.paterno as paterno, 
                persona.materno as materno, 
                persona.fecha_nacimiento as fechaNacimiento, 
                persona.sexo as sexo, 
                persona.correo as correo, 
                persona.telefono as telefono 
        FROM `t_usuarios` AS usuarios 
            INNER JOIN t_cat_roles as roles 
            ON usuarios.id_rol = roles.id_rol 
            INNER JOIN t_persona as persona 
            ON usuarios.id_persona = persona.id_persona;";
$respuesta = mysqli_query($link, $sql);
?>

<!-- posicion de las dobles flechas de la tabla -->
<style>
    .form-control-sm {
        min-height: calc(1.5em + (0.5rem + 2px));
        padding: 0.25rem 1.5rem;
        font-size: .875rem;
        border-radius: 0.2rem;
    }
</style>
<table class="table table-sm dt-responsive nowrap" style="width: 100%;" id="tablaUsuariosDataTable">
    <thead>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Fecha de Nacimiento</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Usuario</th>
        <th>Ubicación</th>
        <th>Sexo</th>
        <th>Cambiar Clave</th>
        <th>Activar</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </thead>
    <tbody>
        <?php
        while ($mostrar = mysqli_fetch_array($respuesta)) {

        ?>
            <tr>
                <td><?php echo $mostrar['nombrePersona']; ?></td>
                <td><?php echo $mostrar['paterno']; ?></td>
                <td><?php echo $mostrar['materno']; ?></td>
                <td><?php echo $mostrar['fechaNacimiento']; ?></td>
                <td><?php echo $mostrar['telefono']; ?></td>
                <td><?php echo $mostrar['correo']; ?></td>
                <td><?php echo $mostrar['nombreUsuario']; ?></td>
                <td><?php echo $mostrar['ubicacion']; ?></td>
                <td><?php echo $mostrar['sexo']; ?></td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalResetPassword" onclick="agregarIdUsuarioReset(<?php echo $mostrar['idUsuario'] ?>)">
                        <span class="fas fa-exchange-alt" style="width: 50px;"></span>
                    </button>
                </td>

                <td>
                    <?php if ($mostrar['estatus'] == 1) { ?>
                        <button class="btn btn-secondary btn-sm" style="color: #fff;" onclick="cambioEstatusUsuario(<?php echo $mostrar['idUsuario'] ?>, <?php echo $mostrar['estatus'] ?>)">
                            <span class="fas fa-toggle-off" style="width: 30px;"></span>Off</button>
                    <?php } else if ($mostrar['estatus'] == 0) { ?>
                        <button class="btn btn-success btn-sm" style="color: #fff;" onclick="cambioEstatusUsuario(<?php echo $mostrar['idUsuario'] ?>, <?php echo $mostrar['estatus'] ?>)">
                            <span class="fas fa-toggle-on" style="width: 30px;"></span>On</button>
                    <?php } ?>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalActualizarUsuarios" onclick="obtenerDatosUsuario(<?php echo $mostrar['idUsuario'] ?>)" style="color: #fff;">
                        <span class="fas fa-user-edit" style="width: 50px;"></span>
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" 
                    onclick="eliminarUsuario(<?php echo $mostrar['idUsuario']; ?> ,<?php echo $mostrar['idPersona']; ?>)">
                        <span class="fas fa-user-times" style="width: 50px;"></span>
                    </button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- insertar registros de usuarios -->
<script>
    $(document).ready(function() {
        $('#tablaUsuariosDataTable').DataTable({
            language: {
                url: "../public/datatable/es_es.json"
            }
        });
    });
</script>
<!-- <script src="../../public/js/usuarios/usu"></script> -->