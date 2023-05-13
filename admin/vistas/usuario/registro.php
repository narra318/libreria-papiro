<?php
    ob_start();
    session_start();
    if (!isset($_SESSION['Admin'])) {
        header('Location: ../../index.php');
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Añadir usuario </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Permite al administrador ingresar nuevos empleados, clientes e incluso administradores.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../../css/custom.css">
    <link rel="stylesheet" href="../../../css/style2.css">
    <link href="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../../../img/fondos/fondo-admin.jpg');
            background-size: 100%;
        }

        #Link a {
            text-decoration: none;
            color: #B9B4BF;
        }

        #Link a:hover {
            text-decoration: none;
            color: white;
            font-size: 17px;
        }
    </style>
</head>

<body class="bg-dark">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menuAdmin("../../../"); ?>

    <?php
        if (isset($_SESSION["ErrorDB"])) {
            echo '<div class="alert alert-warning m-0 alert-dismissible text-center fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> <i class="bi bi-exclamation-circle"></i> Error:</strong> ';
            echo $_SESSION["ErrorDB"];
            echo '</div>';

            unset($_SESSION["ErrorDB"]);
        }

        if (isset($_SESSION["creado"])) {
            echo '<div class="alert alert-success m-0 alert-dismissible fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> Exito:</strong> ';
            echo $_SESSION["creado"];
            echo '</div>';

            unset($_SESSION["creado"]);
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

    <p id="Titulo3" class="text-center text-light mt-5"> Añadir Usuarios <i class="bi bi ms-2"></i> </p>

    <div class="container justify-content-center">
        <form action="../../codigo/usuario/registro.php" method="post" name="registro">

            <div class="row justify-content-center">

                <div class="col-lg-6 justify-content-center">
                    <div class="form-floating m-4">
                        <input type="text"  value="<?php if (isset($_SESSION["registro_data"])) { echo $nombre_value; } ?>"  placeholder="Ingrese su nombre" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" name="nombre" id="nombre" required>
                        <label for="nombre" class="text-light">Nombre</label>
                    </div>

                    <div class="form-floating m-4">
                        <input type="text"  value="<?php if (isset($_SESSION["registro_data"])) { echo $apellido_value; } ?>"  placeholder="Ingrese su apellido" name="apellido" id="apellido"  pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$"  class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="apellido" class="text-light">Apellido</label>
                    </div>

                    <div class="form-floating m-4">
                        <input type="email"  value="<?php if (isset($_SESSION["registro_data"])) { echo $correo_value; } ?>"  placeholder="Ingrese su correo" name="correo" id="correo" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="correo" class="text-light">Correo</label>
                        <?php
                            if (isset($_SESSION["Correo"])) {
                                echo '<div class="alert alert-danger m-0">
                                <strong><i class="bi bi-exclamation-circle-fill"> </i></strong>';
                                echo $_SESSION["Correo"];
                                echo '</div>';
                                unset($_SESSION["Correo"]);
                            }elseif (isset($_SESSION["InvalidoCorreo"])) {
                                echo '<div class="alert alert-warning m-0 text-center alert-dismissible fade show" role="alert">
                                <strong><i class="bi bi-exclamation-circle-fill"> </i></strong> ';
                                echo $_SESSION["InvalidoCorreo"];
                                echo ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                unset($_SESSION["InvalidoCorreo"]);
                            }
                        ?>
                    </div>
                </div>

                <div class="col-lg-6 justify-content-center ">
                    <div class="form-floating m-4">
                        <input type="text"  value="<?php if (isset($_SESSION["registro_data"])) { echo $usuario_value; } ?>"  placeholder="Ingrese su usuario" name="usuario" id="usuario" pattern="[A-Za-z0-9]+"  class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <?php
                            if (isset($_SESSION["user"])) {
                                echo '<div class="alert alert-danger m-0">
                                    <strong> <i class="bi bi-exclamation-circle-fill"> </i> </strong> ';
                                echo $_SESSION["user"];
                                echo '</div>';
                                unset($_SESSION["user"]);
                            }
                        ?><label for="usuario" class="text-light">Usuario</label>
                        
                    </div>

                    <div class="form-floating m-4">
                        <input type="password" placeholder="Ingrese su contraseña" name="pass" id="pass" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="pass" class="text-light">Contraseña</label>
                        <?php
                            if (isset($_SESSION["PassNocoinciden"])) {
                                echo '<div class="alert alert-danger m-0 text-center alert-dismissible fade show" role="alert">
                                        <strong><i class="bi bi-exclamation-circle-fill"> </i> ' . $_SESSION["PassNocoinciden"] . ' </strong> 
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                unset($_SESSION["PassNocoinciden"]);

                            } elseif (isset($_SESSION['PassInvalido'])) {
                                echo '<div class="alert alert-danger m-0 text-center alert-dismissible fade show" role="alert">
                                            <strong><i class="bi bi-exclamation-circle-fill"> </i> ' . $_SESSION['PassInvalido'] . ' </strong> 
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                unset($_SESSION['PassInvalido']);
                            }
                        ?>
                    </div>

                    <div class="form-floating m-4">
                        <input type="password" placeholder="Ingrese su contraseña" name="pass2" id="pass2" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="pass" class="text-light">Validar Contraseña</label>
                    </div>
                </div>
            </div>
            <div class="text-center mb-4 mt-2 me-4">
                <button type="submit" id="enviar" class="btn btn-light rounded">Registrarse</button>
                <a type="button" id="regresar" name="regresar" href="./" class="btn btn-light rounded"> Volver </a>
            </div>

        </form>
    </div>
    </div>
    
    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../../js/jquery-3.6.1.min.js"> </script>
    <?php if (isset($_SESSION["registro_data"])) { unset($_SESSION["registro_data"]); } ?>
</body>

</html>