<?php
    ob_start();
    include 'La-carta.php';
    if (!isset($_SESSION['Status'])) {
        $_SESSION['carritoIngreso'] = "<script> alert('Por favor inicie sesión para añadir productos al carrito'); </script>";
        header('Location: ../vistas/usuario/');
    }

    $cart = new Cart;

    include '../controller/conexion.php';
    $conn = new Configuracion();
    $con = $conn->conectarDB();

    $usuarioId = $_SESSION['idUsuario'];

    $sql = "SELECT idUsuario, name, phone, ciudad, address, masInf FROM clientes WHERE idUsuario = '$usuarioId';";

    $infEnvio = $con->query($sql);
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Información de envio </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="El usuario puede ver su información de envio">
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
    </style>
</head>

<body class="bg-secondary">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>

    <div class="row me-0">
        <div class="col-md-3"> <?=  menuSide("", "","","active","../"); ?> </div>
        <div class="col-md-9 ms-0 contenido" style="height: 100vh; overflow: auto;">
            <?php
                if(isset($_SESSION["actualizadoI"])){
                    echo '<div class="alert alert-success m-0 alert-dismissible fade show text-center">
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        <strong> <i class="bi bi-cloud-check-fill"></i> </strong> &nbsp;';
                    echo $_SESSION["actualizadoI"];
                    echo '</div>';
                    unset($_SESSION['actualizadoI']);
                }

                if(isset($_SESSION["creado"])){
                    echo '<div class="alert alert-success m-0 alert-dismissible fade show text-center">
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        <strong> <i class="bi bi-cloud-check-fill"></i> </strong> &nbsp;';
                    echo $_SESSION["creado"];
                    echo '</div>';
                    unset($_SESSION['creado']);
                }

                if (mysqli_num_rows($infEnvio) == 0) {  
                    $_SESSION['NoInfo'] = "Por favor agregue una dirección de envio.";
                    header("location: agregarInfo.php");
                }else{ 
            ?>
            <div class="container text-center p-5 h4">
                <h1 class="text-center mb-5" id="Titulo1"> Su información de envio es: <i class="bi bi-send"></i> </h1>
                <?php
                    while ($row = $infEnvio->fetch_assoc()) {
                ?>
                <span><p> Nombre: <?php echo $row['name'] ?></p></span>
                <span><p> Telefono: <?php echo $row['phone'] ?></p></span>
                <span><p> Dirección: <?php echo $row['address'] ?> | <?php echo $row['ciudad'] ?> </p></span>
                <span><p> Más Info: <?php echo $row['masInf'] ?></p></span>
                
                <div class="text-center d-grid mt-5 mx-auto" style="padding-top: 60px; width: 50vw;"><a type="button" href="modInfoEnv.php" class="btn btn-primary rounded"> Editar &nbsp; <i class="bi bi-pencil-square"></i> </a></div>

                <?php
                    }} // endwhile
                ?>
            </div>
        </div>
    </div>

    <?= footer(); ?>    
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
</body>
</html>