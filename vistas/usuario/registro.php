<?php
ob_start();
session_start();
if (isset($_SESSION["Status"])) {
    header('Location: ./logeado/index.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Registrarse </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Este formulario permite a los usuarios registrarse en caso de no estar registrados y deseen logearse">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icono2.png" type="image/ico" />
    <link rel="apple-touch-icon" href="../../img/icono2.png">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/login_reg.css">
</head>

<body class="bg-secondary">
    <?php include '../../modules/menu-footer.php'; ?>
    <?= menu("../.."); ?>

    <?php
    if (isset($_SESSION["ErrorDB"])) {
        echo '<div class="alert alert-warning m-0 alert-dismissible text-center fade show">
            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            <strong> <i class="bi bi-exclamation-circle"></i> ERROR:</strong> ';
        echo $_SESSION["ErrorDB"];
        echo '</div>';

        unset($_SESSION["ErrorDB"]);
    }

    if (isset($_SESSION["registro_data"])) {
        $registro_data = $_SESSION["registro_data"];

        // Rellenar los campos del formulario con los valores del array
        $correo_value = isset($registro_data['correo']) ? $registro_data['correo'] : '';
        $nombre_value = isset($registro_data['nombre']) ? $registro_data['nombre'] : '';
        $apellido_value = isset($registro_data['apellido']) ? $registro_data['apellido'] : '';
        $usuario_value = isset($registro_data['usuario']) ? $registro_data['usuario'] : '';
    }
    ?>


    <div class="body">

        <!-- Formulario -->
        <div class="containerLogin p-4 mt-5 mb-5" style="width: 50em;">
            <?php
                if (isset($_SESSION["PassNocoinciden"])) {
                    echo '<div class="alert alert-info rounded m-0 text-center alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-circle-fill"> </i> Error: ' . $_SESSION["PassNocoinciden"] . ' </strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                    unset($_SESSION["PassNocoinciden"]);
                } elseif (isset($_SESSION['PassInvalido'])) {
                    echo '<div class="alert alert-info rounded m-0 text-center alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-circle-fill"> </i> ' . $_SESSION['PassInvalido'] . ' </strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                    unset($_SESSION['PassInvalido']);
                }
            ?>

            <div class="container-fluid text-center text-white mt-5 p-2" id="Titulo1">
                <h1 id="Titulo1"> Registrarse </h1>
            </div>

            <div class="container mb-5">
                <form role="form" name="registro" class="m-3" action="../../codigo/usuario/registro.php" method="post">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating m-4">
                                <input type="text" value="<?php if (isset($_SESSION["registro_data"])) {
                                                                echo $nombre_value;
                                                            } ?>" placeholder="Ingrese su nombre" name="nombre" id="nombre" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" minlength="2" maxlength="25" required>
                                <label for="nombre" class="text-dark fw-semibold"> Nombre</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating m-4">
                                <input type="text" value="<?php if (isset($_SESSION["registro_data"])) {
                                                                echo $apellido_value;
                                                            } ?>" placeholder="Ingrese su apellido" name="apellido" id="apellido" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" minlength="2" maxlength="25" required>
                                <label for="apellido" class="text-dark fw-semibold"> Apellido </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating m-4">
                                <input type="email" value="<?php if (isset($_SESSION["registro_data"])) {
                                                                echo $correo_value;
                                                            } ?>" placeholder="Ingrese su correo" name="correo" id="correo" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" maxlength="50" required>
                                <label for="correo" class="text-dark fw-semibold"> <i class="bi bi-envelope"> &nbsp; </i> Correo</label>
                                <?php
                                if (isset($_SESSION["Correo"])) {
                                    echo '<div class="alert alert-warning m-0 text-center">
                                    <strong><i class="bi bi-exclamation-circle-fill"> </i> Error: </strong> ';
                                    echo $_SESSION["Correo"];
                                    echo '</div>';
                                    unset($_SESSION["Correo"]);
                                } elseif (isset($_SESSION["InvalidoCorreo"])) {
                                    echo '<div class="alert alert-warning m-0 text-center alert-dismissible fade show" role="alert">
                                    <strong><i class="bi bi-exclamation-circle-fill"> </i> Error: </strong> ';
                                    echo $_SESSION["InvalidoCorreo"];
                                    echo ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                    unset($_SESSION["InvalidoCorreo"]);
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating m-4">
                                <input type="text" value="<?php if (isset($_SESSION["registro_data"])) {
                                                                echo $usuario_value;
                                                            } ?>" placeholder="Ingrese su usuario" name="usuario" id="usuario" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" pattern="[A-Za-z0-9]+" maxlength="20" required>
                                <label for="usuario" class="text-dark fw-semibold"> <i class="bi bi-person"> &nbsp; </i> Usuario</label>
                                <?php
                                if (isset($_SESSION["user"])) {
                                    echo '<div class="alert alert-warning m-0 text-center alert-dismissible fade show" role="alert">
                                    <strong> <i class="bi bi-exclamation-circle-fill"> </i> Error:</strong> ';
                                    echo $_SESSION["user"];
                                    echo ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                    unset($_SESSION["user"]);
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="form-floating m-4 me-2 text-center">
                                    <input type="password" placeholder="Ingrese su contraseña" name="pass" id="pass" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" required>
                                    <label for="pass" class="text-dark fw-semibold"> <i class="bi passIcon bi-lock"></i> Contraseña</label>
                                </div>
                                
                                <button class="ojo btn btn-outline-primary rounded-pill ms-0 m-4 me-1" type="button" id="m1" onclick="mostrarContraseña('pass')"> <strong> <i class="bi bi-eye"></i> </strong></button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="form-floating m-4 me-2 text-center">
                                    <input type="password" placeholder="Ingrese su contraseña" name="pass2" id="pass2" maxlength="25" class="form-control bg-secondary bg-opacity-75 text-dark fw-semibold border-bottom border-primary" required>
                                    <label for="pass2" class="text-dark fw-semibold"> <i class="bi passIcon bi-lock"></i> Confirmar contraseña</label>
                                </div>
                                
                                <button class="ojo btn btn-outline-primary rounded-pill ms-0 m-4 me-1" id="m2" type="button" onclick="mostrarContraseña('pass2')"> <strong> <i class="bi bi-eye"></i> </strong></button>
                        </div>
                        </div>
                    </div>

                    <div class="text-center mt-5 mb-4 d-grid">
                        <div class="btn-group mt-2 mb-2">
                            <button type="submit" class="btn btn-primary border border-dark rounded ms-5"> Registrarse <i class="bi bi-person-plus-fill ms-3"></i> </button>
                            <a type="button" href="index.php" class="btn btn-outline-primary border border-primary rounded ms-4 me-5"> Volver </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= footer(); ?>

    <script src="../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../js/jquery-3.6.1.min.js"></script>
    <script>
        var iconoOjo1 = document.getElementsByClassName("passIcon")[0];
        var iconoOjo2 = document.getElementsByClassName("passIcon")[1];

        function mostrarContraseña(inputId) {
            var input = document.getElementById(inputId);

            if (input.type === "password") {
                input.type = "text";
                iconoOjo1.classList.replace("bi-lock", "bi-unlock");
                iconoOjo2.classList.replace("bi-unlock", "bi-lock");
            } else {
                input.type = "password";
                iconoOjo1.classList.replace("bi-unlock", "bi-lock");
                iconoOjo2.classList.replace("bi-lock", "bi-unlock");
            }
        }
    </script>

    <?php if (isset($_SESSION["registro_data"])) {
        unset($_SESSION["registro_data"]);
    } ?>
</body>

</html>