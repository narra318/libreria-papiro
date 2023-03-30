<?php
    ob_start();
    include 'La-carta.php';
    if(!isset($_SESSION['Status'])){
        header('Location: ../index.php');
    }

    $cart = new Cart;
    include 'Configuracion.php';


    if ($cart->total_items() <= 0) {
        header("Location: ../vistas/libreria/catalogo.php");
    }

    $query = $db->query("SELECT * FROM clientes WHERE idUsuario = " . $_SESSION['idUsuario']);
    $custRow = $query->fetch_assoc();

    
    
    include '../controller/conexion.php';
    $conexion = new Configuracion();
    $con = $conexion -> conectarDB();
    $usuarioId = $_SESSION['idUsuario'];

    $sql = "SELECT id, idUsuario, name, phone, ciudad, address, masInf FROM clientes 
    WHERE idUsuario='$usuarioId';";

    $infoEnv = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Pagos </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Página de catálago de la libreria papiro">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
        }

        .table {
            width: 65%;
            float: left;
        }

        .shipAddr {
            width: 30%;
            float: left;
            margin-left: 30px;
        }

        .footBtn {
            width: 95%;
            float: left;
        }

        .orderBtn {
            float: right;
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
    </style>
</head>

<body class="bg-secondary text-dark">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>

    <div class="row me-0">
        <div class="col-3"> <?=  menuSide("", "active","","","../"); ?> </div>
        <div class="col-9 ms-0 contenido" style="height: 100vh; overflow: auto;">
        <?php
            if (mysqli_num_rows($infoEnv) == 0) {  
                $_SESSION['NoInfo'] = "Por favor agregue una dirección de envio.";
                header("location: agregarInfo.php");
            }else{ 
        ?>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body mt-5">
                <h1 id="Titulo1" class="text-center mb-5">Vista previa de la Orden</h1>
                <table class="table mt-5 text-dark">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Sub total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($cart->total_items() > 0) {
                            //get cart items from session
                            $cartItems = $cart->contents();
                            foreach ($cartItems as $item) {
                        ?>
                                <tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo '$' . number_format($item["price"]) . ' COP'; ?></td>
                                    <td><?php echo $item["qty"]; ?></td>
                                    <td><?php echo '$' . number_format($item["subtotal"]) . ' COP'; ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">
                                    <p>No hay articulos en tu carta......</p>
                                </td>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <?php if ($cart->total_items() > 0) { ?>
                                <td class="text-center"><strong>Total <?php echo '$' . number_format($cart->total()) . ' COP'; ?></strong></td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
                <div class="shipAddr mt-2">
                    <h4>Detalles de envío</h4>
                    <p class="h4"> ------------------------------- </p>
                    <p class="text-uppercase">Nombre: <?php echo $custRow['name']; ?></p>
                    <p class="text-uppercase">Telefono: <?php echo $custRow['phone']; ?></p>
                    <p class="text-uppercase">Ciudad: <?php echo $custRow['ciudad']; ?> </p>
                    <p class="text-uppercase">Dirección: <?php echo $custRow['address']; ?></p>
                    <p class="text-uppercase">Más Inf: <?php echo $custRow['masInf']; ?></p>
                </div>
                <div class="footBtn mt-4">
                    <a href="verCarta.php" class="btn btn-primary rounded"><i class="glyphicon glyphicon-menu-left"></i> Volver </a>
                    <a href="AccionCarta.php?action=placeOrder" class="btn btn-primary rounded orderBtn">Realizar pedido <i class="glyphicon glyphicon-menu-right"></i></a>
                </div>
            </div>
        </div>
        <!--Panek cierra--><?php } ?>
    </div></div><?= footer(); ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>