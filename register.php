<?php
session_start();
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

$rol = $err_idrol = "";
$persona = $err_idpersona = "";
$ubi = $err_ubi = "";
$fecha = $err_fecha = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese un usuario.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_usuario FROM t_usuarios WHERE usuario = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este usuario ya fue tomado.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }


    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingresa una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Confirma tu contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "No coincide la contraseña.";
        }
    }

    // VALIDATE IDROL, IDPERSONA, UBICACION Y FECHA
    if (empty(trim($_POST["rol"]))) {
        $err_idrol = "Por favor ingrese el id de su rol.";
    } elseif (strlen(trim($_POST["rol"])) < 1) {
        $err_idrol = "El id ingresado no es válido.";
    } else {
        $rol = trim($_POST["rol"]);
    }

    // VALIDACION DEL ID PERSONA

    if (empty(trim($_POST["persona"]))) {
        $err_idpersona = "Por favor seleccione una opción.";
    } else {

        // $Usuario = $_SESSION["username"];

        // $idPersona = "SELECT usuario.id_persona as idPersona
        //         FROM t_usuarios as usuario 
        //         inner join t_persona as persona 
        //         on usuario.id_persona = persona.id_persona 
        //         and usuario.id_usuario = '$Usuario'";



        $sql = "SELECT id_persona FROM t_usuarios WHERE id_persona = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_persona);
            $param_persona = trim($_POST["persona"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $err_idpersona = "Ya existe una cuenta asociada a esta persona, favor de 
                                      contactarse con su Administrador.";
                } else {
                    $persona = trim($_POST["persona"]);
                }
            } else {
                echo "Al parecer algo salió mal.";
            }
        }
        // mysqli_stmt_close($stmt);
    }


    //FIN VALIDACION DEL ID PERSONA

    if (empty(trim($_POST["ubi"]))) {
        $err_ubi = "Por favor la direccion de su ubicación.";
    } elseif (strlen(trim($_POST["ubi"])) == null) {
        $err_ubi = "No a ingresado una ubicación.";
    } else {
        $ubi = trim($_POST["ubi"]);
    }

    // if (empty(trim($_POST["fecha"]))) {
    //     $err_fecha = "Por favor ingrese una fecha.";
    // } elseif (strlen(trim($_POST["fecha"])) == null) {
    //     $err_fecha = "No a ingresado una fecha.";
    // } else {
    //     $fecha = trim($_POST["fecha"]);
    // }
    // FIN VALIDATE IDROL, IDPERSONA, UBICACION Y FECHA
    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO t_usuarios (id_rol, id_persona, usuario, password, ubicacion) 
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_idrol, $param_idpersona, $param_username, $param_password, $param_ubi);

            // Set parameters
            $param_idrol = $rol;
            $param_idpersona = $persona;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            $param_ubi = $ubi;
            // $param_fecha = $fecha;

            //Store data of rol de usuario in variable
            $_SESSION['usuario']['rol'] = $rol;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }

        // Close statement
        // mysqli_stmt_close($stmt);
    }

    // Close connection
    // mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            background-color: #D2E3F4;
            color: #020206;
        }

        .wrapper {
            width: 380px;
            padding: 20px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Registro</h2>
        <p>Por favor complete este formulario para crear una cuenta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar Contraseña</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php //echo $confirm_password; 
                                                                                            ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <!-- DEMAS CAMPOS DE LA TABLA t_usuarios -->
            <div class="form-group <?php echo (!empty($err_idrol)) ? 'has-error' : ''; ?>">
                <label>Id Rol:</label>
                <select value="" name="rol" class="form-control form-select" required>
                    <option value="<?php echo $rol = 1; ?>">Cliente</option>
                </select>
                <!-- <input type="text" name="rol" class="form-control" value="<?php //echo $rol; 
                                                                                ?>"> -->
                <span class="help-block"><?php echo $err_idrol; ?></span>
            </div>


            <div class="form-group <?php echo (!empty($err_idpersona)) ? 'has-error' : ''; ?>">
                <label>Cliente:</label>

                <?php
                // $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $sql = "SELECT persona.id_persona as id_persona, concat(persona.paterno,' ',persona.materno,' ',persona.nombre) AS nombre
                                    FROM t_persona AS persona     
                                    ORDER BY persona.paterno;";
                //se obtiene a las personas
                // $respuesta = mysqli_query($link, $sql);

                ?>

                <select name="persona" id="persona" class="form-control form-select" required>
                    <option value="">Seleccione una opción</option>
                    <?php
                    if ($respuesta = mysqli_query($link, $sql)) {
                        while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                            <option value="<?php echo $mostrar['id_persona']; ?>"><?php echo $mostrar['id_persona'].'-'.$mostrar['nombre']; ?></option>
                        <?php }
                    } //else {
                        //while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                            <!-- <option value="<?php //echo $mostrar['id_persona']; ?>"><?php //echo $mostrar['nombre']; ?></option> -->
                    <?php  //}
                    //}
                    ?>
                </select>
                <!-- <input type="text" name="persona" class="form-control" value="<?php //echo $persona; 
                                                                                    ?>"> -->
                <span class="help-block"><?php echo $err_idpersona; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($err_ubi)) ? 'has-error' : ''; ?>">
                <label>Ubicación:</label>
                <input type="text" name="ubi" class="form-control" value="<?php echo $ubi; ?>">
                <span class="help-block"><?php echo $err_fecha; ?></span>
            </div>


            <!-- <div class="form-group <?php //echo (!empty($err_fecha)) ? 'has-error' : ''; 
                                        ?>">
                <label>Fecha:</label>
                <input type="text" name="fecha" class="form-control" placeholder="YY-MM-DD h:m:s" value="<?php //echo $fecha; 
                                                                                                            ?>">
                <span class="help-block"><?php //echo $err_fecha; 
                                            ?></span>
            </div> -->
            <!-- DEMAS CAMPOS DE LA TABLA t_usuarios -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
                <input type="reset" class="btn btn-default" value="Borrar">
            </div>
            <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
        </form>
    </div>
</body>

</html>