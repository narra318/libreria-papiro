<?php
    ob_start();
    session_start();
    if (!isset($_SESSION['Status'])) {
        $_SESSION['carritoIngreso'] = "<script> alert('Por favor inicie sesión'); </script>";
        header('Location: ../vistas/usuario/');
    }

    include '../controller/conexion.php';
    $conexion = new Configuracion();
    $con = $conexion -> conectarDB();
    $usuarioId = $_SESSION['idUsuario'];

    $sql = "SELECT id, idUsuario, name, phone, ciudad, address, masInf FROM clientes 
    WHERE idUsuario='$usuarioId' LIMIT 21;";

    $inf= $con->query($sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Agregar Información de Envío </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="El usuario puede agregar su dirección de envio.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
        }

        input[type="number"] {
            width: 20%;
        }
        .menu-side:hover{
            color: #ffffff;
            text-shadow: 0px 0px 20px #B9B4BF;
        }

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
            background-color: #88456a;
            color: #ffffff;
            text-shadow: 0px 0px 10px #ffffff;
        }

        .hoverPedido:hover{
            background-color: #88456a59;
        }      
        
        .sub-menu-cont::-webkit-scrollbar{
        width: 8px;
        background-color: #ffffff4d;
        }

        .sub-menu-cont::-webkit-scrollbar-thumb{
        background-color: #ffffffcb;
        border-radius: 7px;
        }

        .sub-menu-cont::-webkit-scrollbar-thumb:hover{
        background-color: #ffffff;
        } 

    </style>
</head>

<body class="bg-secondary">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>

    <div class="row me-0">
        <div class="col-3"> <?=  menuSide("", "","","active","../"); ?> </div>

        <div class="col-9 ms-0 sub-menu-cont" style="height: 100vh; overflow: auto;">

        <?php
            if(isset($_SESSION['NoInfo'])){
                echo '<div class="alert alert-danger m-0 alert-dismissible fade show text-center">
                    <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                    <strong> <i class="bi bi-exclamation-circle-fill"></i> </strong> &nbsp;';
                echo $_SESSION['NoInfo'];
                echo '</div>';
                unset($_SESSION['NoInfo']);
            }
            if(isset($_SESSION["ErrorDB"])){
                echo '<div class="alert alert-danger m-0 alert-dismissible fade show text-center">
                    <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                    <strong> <i class="bi bi-exclamation-circle-fill"></i> </strong> &nbsp;';
                echo $_SESSION['ErrorDB'];
                echo '</div>';
                unset($_SESSION["ErrorDB"]);
            }
        
        if (mysqli_num_rows($inf) == 0) { 
             ?>
            <h1 class="text-center mt-5" id="Titulo1"> Agregar Información de Envío</h1>

            <form action="add.php" method="POST" class="p-3">
                <div class="form-floating m-4 mt-5">
                    <input type="text" placeholder="Ingrese su nombre" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" maxlength="60" name="nombre" id="nombre" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" required>
                    <label for="nombre" class="text-dark fw-semibold"> Nombre Completo</label>
                </div>

                <div class="input-group">
                    <div class="form-floating m-4">
                        <input type="text" placeholder="Ingrese su teléfono" pattern="[0-9]{1,10}" minlength="9" maxlength="10" name="telefono" id="telefono" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" required>
                        <label for="telefono" class="text-dark fw-semibold"> Teléfono</label>
                    </div>
                    
                    <div class="form-floating m-4">
                        <input type="text" placeholder="Ingrese su ciudad" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" maxlength="25" name="ciudad" id="ciudad" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" required>
                        <label for="ciudad" class="text-dark fw-semibold"> Ciudad </label>
                    </div>    
                </div>
                <div class="input-group">
                    <div class="form-floating m-4">
                        <input type="text" placeholder="Ingrese su dirección" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9@#\$\-]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ0-9@#\$\-]+)*$" maxlength="50" name="direccion" id="direccion" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary" required>
                        <label for="direccion" class="text-dark fw-semibold"> Dirección </label>
                    </div>
                    
                    <div class="form-floating m-4">
                        <input type="text" placeholder="Ingrese más información si es necesaria" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]+)*$" maxlength="40" name="masInfo" id="masInfo" class="form-control bg-secondary bg-opacity-50 text-dark fw-semibold border-bottom border-primary">
                        <label for="masInfo" class="text-dark fw-semibold"> Más Información (Edificio/Apto) </label>
                    </div>    
                </div>

                <div class="text-end mt-5">
                    <button type="submit" class="btn btn-primary rounded" name="modificar" id="modificar"> Agregar &nbsp; <i class="bi bi-send-plus"></i> </button>
                </div>
            </form>
        <?php 
         }else{
            header("location: infEnvio.php");
         } ?>
        </div>


    <?= footer(); ?>    </div>
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
</body>
</html>