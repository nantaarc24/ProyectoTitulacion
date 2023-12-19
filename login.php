<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
//Compruebe si el usuario ya ha iniciado sesión; en caso afirmativo, rediríjalo a la página de bienvenida
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location:welcome.php");
//     exit;
// }

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese su usuario.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id_rol, usuario, password, activo FROM t_usuarios WHERE usuario = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result - aqui tenemos el id rol
                $datosUsuario= mysqli_stmt_store_result($stmt);
                // echo $activo= $datosUsuario['activo'];
                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $activo);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password) && $activo == 1) {
                            
                            
                            // Password is correct, so start a new session
                            session_start();
                            

                            // Store data in session variables (id= id rol)
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // sirve pero ya no es necesario xd
                            $_SESSION['usuario']['nombre'] = $datosUsuario['usuario'];
                            $_SESSION['usuario']['id'] = $datosUsuario['id_usuario'];
                            $_SESSION['usuario']['rol'] = $datosUsuario['id_rol'];
                            // Redirect user to welcome page
                            header("location:vistas/inicio.php");
                        } 
                        elseif(password_verify($password, $hashed_password) && $activo != 1){
                            $password_err = "Su cuenta a sido desactivada favor de comunicarse con el Administrador.";
                        }
                        else {
                            // Display an error message if password is not valid
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } 
                
                else {
                    // Display an error message if username doesn't exist
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="images/icono.jpeg" style="height: 130px; width: 130px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soporte Técnico Help-Desk</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <style type="text/css">
        body {
            font: 14px sans-serif;
            background-image:url("images/logo3.jpeg");
            /* background-position: 100% 100%; */
            /* background-size: cover; */
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>

</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- <h2>Login ConfiguroWeb</h2> -->
            <!-- Icon -->
            <div class="fadeIn first">
                <img src="public/img/hdlogo.png" id="icon" alt="User Icon" />
                <link rel="stylesheet" href="public/bootstrap/bootstrap.min.css">
                <link rel="stylesheet" href="public/css/login.css">
                <h1 style="color: #60a0ff; font-family: Poppins, sans-serif; font-size: 40px;">Help-Desk</h1>
            </div>
            <p>Por favor, complete sus credenciales para iniciar sesión.</p>
            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                <div class=" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label></label>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
                    <input type="text" name="username" placeholder="username" class="fadeIn second" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class=" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label></label>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
                    <input type="password" name="password" placeholder="password" class="fadeIn third">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="">
                    <input type="submit" class="fadeIn fourth" value="Ingresar">
                </div>
                <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" data-toggle="modal" data-target="#modalContacto" href="#">Contactar con el Administrador.</a>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <style>
        .modal-backdrop.show {
            opacity: .5;
        }
        
    </style>
    <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 77px;" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 18px;" id="exampleModalLabel">Contacto</h5>
                    <button type="button" style="margin-top: -10px; font-size: 27px; color: #000;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 18px;">
                    Estimado cliente, si no cuenta con sus credenciales favor de comunicarse al número 935-704-087 o al correo helpdesk@outlook.es.
                </div>
                <div class="modal-footer">
                    <button type="button" style="font-size: 15px;" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>

    <!--FIN MODAL BOOSTRAP -->

    <script src="public/jquery/jquery-3.6.0.min.js"></script>
    <script src="public/bootstrap/popper.min.js"></script>
    <script src="public/bootstrap/bootstrap.min.js"></script>
    <script src="public/sweetalert2/sweetalert2@11.js"></script>

</body>

</html>