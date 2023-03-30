<?php
    ob_start();
    session_start();

    if(isset($_SESSION['Foro2'])){
        echo $_SESSION['Foro2'];
        unset($_SESSION["Foro2"]);
    }

    if(isset($_SESSION['carritoIngreso'])){
        echo $_SESSION['carritoIngreso'];
        unset($_SESSION["carritoIngreso"]);
    }

    if(isset($_SESSION["Status"])){
        header ('Location: ./logeado/index.php'); 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title> Iniciar Sesión </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Este formulario es el inicio de sesion de los usuarios, para acceder a las funciones de la libreria.">
    <link rel="shortcut icon" href="../../img/icono2.png" type="image/ico" />
    <link rel="apple-touch-icon" href="../../img/icono2.png">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/login_reg.css">
    <link href ="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <?php include '../../modules/menu-footer.php'; ?>
    <?= menu("../.."); ?>

    <?php 
        if(isset($_SESSION["Error"])){
            echo '<div class="alert alert-danger m-0"><i class="bi bi-exclamation-diamond-fill"> </i>';
            echo $_SESSION["Error"];
            echo '</div>';
            unset($_SESSION["Error"]);
        }
    ?>

<div class="body">
    <!-- Formulario -->

    <div class="containerLogin p-5 mt-5 mb-5" style="width: 35em;">
        <div class="container-fluid text-center text-white mt-5 p-2" >
            <h1 id="Titulo1"> Iniciar Sesión</h1>
        </div>

        <form action="../../codigo/usuario/login.php" class="ms-2 me-2" method="POST" >
            <div class="form-floating m-4">
                <input type="text" class="form-control bg-secondary bg-opacity-75 text-dark border-bottom border-primary" id="email" placeholder="Ingrese su email o usuario" name="email" required>
                <label for="email" style="color: var(--primary)"> <i class="bi bi-person"></i> Usuario o email:</label>
            </div>
            <div class="form-floating m-4">
                <input type="password"" class="form-control bg-secondary bg-opacity-75 text-dark border-bottom border-primary" id="password" placeholder="Ingrese su Contraseña" name="password" required>
                <label for="password" style="color: var(--primary)">  <i class="bi bi-lock"></i> Password:</label>
            </div>
            <div class="form-floating m-4">
                <a href="../../codigo/usuario/restablecer_contrasena.php" class="btn btn-link">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="text-end mt-5 mb-4">
                <div class="btn-group mt-2">
                    <button type="submit" class="btn btn-outline-primary rounded ms-4 me-4  border border-primary">  Iniciar Sesión <i class="bi bi-door-open ms-2"></i></button>
                    <a type="button" href="registro.php" class="btn btn-outline-primary rounded ms-4 me-4">  Registrarse  <i class="bi bi-card-heading ms-2"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

    <?= footer(); ?>
    <script src="../../js/bootstrap.bundle.min.js"> </script>
</body>
</html>