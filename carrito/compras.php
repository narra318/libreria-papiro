<?php
    ob_start();
    include 'La-carta.php';
    if (!isset($_SESSION['Status'])) {
        $_SESSION['carritoIngreso'] = "<script> alert('Por favor inicie sesión para añadir productos al carrito'); </script>";
        header('Location: ../vistas/usuario/');
    }

    $cart = new Cart;

    include '../controller/conexion.php';
    $conexion = new Configuracion();
    $con = $conexion -> conectarDB();
    $usuarioId = $_SESSION['idUsuario'];

    $sql = "SELECT orden.id, orden.customer_id, orden.total_price, orden.created, orden.status 
    FROM orden INNER JOIN clientes
    WHERE clientes.idUsuario = '$usuarioId' AND orden.customer_id = clientes.id ORDER BY created DESC;";

    $orden = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Compras/Pedidos </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="El usuario puede ver las compras realizadas.">
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
        background-color: #bc8bda4d;
        }

        .sub-menu-cont::-webkit-scrollbar-thumb{
        background-color: #bc8bdacb;
        border-radius: 7px;
        border: 1px solid #956fad;
        }

        .sub-menu-cont::-webkit-scrollbar-thumb:hover{
        background-color: #bc8bda;
        } 

    </style>
</head>

<body class="bg-secondary">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>

    <div class="row me-0">
        <div class="col-3"> <?=  menuSide("", "","active","","../"); ?> </div>

        <div class="col-9 ms-0 sub-menu-cont" style="height: 100vh; overflow: auto;">
            <div class="container mt-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-center mb-5" id="Titulo1"><i class="bi bi-bag"></i> Sus pedidos son:  </h1>
                    </div>
                </div>

                <div class="">
                    <?php
                        while($fila = mysqli_fetch_array($orden)){
                            $id = $fila['id'];
                            $idCliente = $fila['customer_id'];
                            $total = number_format($fila['total_price']);
                            $created = $fila['created'];
                            $created = date("d-m-Y", strtotime($created));
                            $estado = $fila['status'];

                        
                            echo <<< CUADRO
                                <a href="descripcion.php?id=$id" class="text-primary">
                                    <div class="border border-primary hoverPedido rounded mb-4 p-4">
                                        <p class="text-end text-primary"> Fecha de la compra: $created </p>
                                        <p class="h3 mb-4"> El valor de la compra fue: $$total </p>
                                    </div> 
                                </a>
                            CUADRO;
                        }
                    ?>
            </div>
        </div>
    </div>


<?= footer(); ?>    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>