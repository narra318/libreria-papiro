<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title> Información del pedido </title>
    <meta charset="UTF-8">
    <meta name="description" content="Página de detalle de una compra - libreria papiro">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        background-color: #88456a4d;
        }

        .sub-menu-cont::-webkit-scrollbar-thumb{
        background-color: #88456acb;
        border-radius: 7px;
        border: 1px solid #572c44;
        }

        .sub-menu-cont::-webkit-scrollbar-thumb:hover{
        background-color: #88456a;
        } 

    </style>
</head>

<body class="bg-secondary">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>

    <div class="row me-0">
        <div class="col-3"> <?=  menuSide("", "","active","","../"); ?> </div>
        <div class="col-9 ms-0 contenido" style="height: 100vh; overflow: auto;">
            <?php
                include "../controller/conexion.php";

                $conn = new Configuracion();
                $con = $conn->conectarDB();

                $id = $_GET['id'];
                $usuarioId = $_SESSION['idUsuario'];
                
                $sql = "SELECT * FROM orden_articulos 
                INNER JOIN orden ON orden_articulos.order_id = orden.id
                INNER JOIN clientes ON orden.customer_id = clientes.id
                INNER JOIN libro ON orden_articulos.product_id = libro.idLibro
                INNER JOIN usuario ON clientes.idUsuario = usuario.idUsuario 
                WHERE clientes.idUsuario = '$usuarioId' AND order_id = $id;";

                $resulset = $con->query($sql);

                $sql2 = "SELECT orden.id, orden.customer_id, orden.total_price, orden.created, orden.status 
                FROM orden INNER JOIN clientes
                WHERE orden.customer_id = clientes.id AND orden.id = $id;";

                $orden = mysqli_query($con, $sql2);

            ?>
            
            <div class="mt-5 mb-2 "><a href="compras.php" class="btn btn-primary rounded" style="background-color: #53213d;">  <i class="bi bi-arrow-left"></i> </a></div>
            <h1 id="Titulo1" class="mt-5 mb-2 text-center"> Información del pedido: </h1>
            

            <?php while($fila = mysqli_fetch_array($orden)){
                    $created = $fila['created'];
                    $created = date("d/m/Y", strtotime($created));
                    $total = number_format($fila['total_price']);
            ?>
            <div class="row">
                <div class="col"><p class="h3 mt-5 ms-4 mb-2 text -center "> Fecha: <?php echo $created ?></p></div>
                <div class="col"><p class="h3 mt-5 mb-2 text-end me-5">Total: $<?php echo $total ?> COP </p></div>
            </div>

            <?php } ?>
            
            <div class="overflow-auto p-4">
                    <table class="table border border-primary text-center text-primary">
                        <tr class="bg-info bg-opacity-50"> 
                            <!-- <th class="border border-primary"> Usuario: </th>  -->
                            <th class="border border-primary"> Producto: </th> 
                            <th class="border border-primary"> N° orden: </th> 
                            <th class="border border-primary"> Precio: </th> 
                            <th class="border border-primary"> Cant: </th> 
                            <th class="border border-primary"> Subtotal: </th> 
                        </tr>
                    
            <?php while ($row = $resulset->fetch_assoc()) { ?>
                
                        <tr>
                            <!-- <td class="border border-primary"> <?php  $row['usuario']; ?> </td> -->
                            <td class="border border-primary"> <?php echo $row['nombreLibro']; ?> </td>
                            <td class="border border-primary"> #APPR<?php echo $row['order_id']; ?> </td>
                            <td class="border border-primary"> $<?php echo number_format($row['precioLibro']); ?> COP </td>
                            <td class="border border-primary"> <?php echo $row['quantity']; ?> </td>
                            <td class="border border-primary"> $<?php echo number_format($row['precioLibro']*$row['quantity']); ?> COP </td>
                        </tr>
            <?php } ?>
                    </table>
                </div>
             </div>
        </div>
    </div>


<?= footer(); ?>    </div>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
</body>
</html>