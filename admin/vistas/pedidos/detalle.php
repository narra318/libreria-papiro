<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title> Pedidos </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Pagina para ver las ventas y/o pedidos.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../../css/custom.css">
    <link rel="stylesheet" href="../../../css/style2.css">
    <link href ="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/jquery.dataTables.min.css">
    <style>
        body{
            background-image: url('../../../img/fondos/fondo-admin.jpg');
            background-size: 100%;
        }

        #Link a{
            text-decoration: none;
            color: #B9B4BF;
        }#Link a:hover{
            text-decoration: none;
            color: white;
        }

    </style>
</head>
<body class="bg-dark mb-4">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menuAdmin("../../../"); ?>

    <div class="container mt-5">
            <?php
                include "../../codigo/controller/conexion.php";
                $con = new Configuracion;
                $con = $con->conectarDB();

                $id = $_GET['id'];
                
                $sql = "SELECT * FROM orden_articulos 
                INNER JOIN orden ON orden_articulos.order_id = orden.id
                INNER JOIN clientes ON orden.customer_id = clientes.id
                INNER JOIN libro ON orden_articulos.product_id = libro.idLibro
                INNER JOIN usuario ON clientes.idUsuario = usuario.idUsuario 
                WHERE orden.customer_id = clientes.id AND orden.id = $id;";

                $resulset = $con->query($sql);

                $sql2 = "SELECT orden.id, orden.customer_id, orden.total_price, orden.created, orden.status 
                FROM orden INNER JOIN clientes
                WHERE orden.customer_id = clientes.id AND orden.id = $id;";

                $orden = mysqli_query($con, $sql2);

            ?>
            
            <div class="mt-5 mb-2 "><a href="index.php" class="btn btn-info rounded">  <i class="bi bi-arrow-left"></i> </a></div>
            <h1 id="Titulo3" class="mt-5 mb-2 text-center"> Información del pedido: </h1>
            

            <?php while($fila = mysqli_fetch_array($orden)){
                    $created = $fila['created'];
                    $created = date("d/m/Y", strtotime($created));
                    $total = number_format($fila['total_price']);
            ?>
            <div class="row">
                <div class="col"><p class="h3 mt-5 ms-4 mb-2 text-light"> Fecha: <?php echo $created ?></p></div>
                <div class="col"><p class="h3 mt-5 mb-2 text-light text-end me-5">Total: $<?php echo $total ?> COP </p></div>
            </div>

            <?php } ?>
            
            <div class="overflow-auto p-4">
                    <table class="table overflow-auto text-center">
                        <thead>
                            <tr class="text-white bg-info bg-opacity-75 text-center"> 
                                <th class="border border-info"> Usuario: </th> 
                                <th class="border border-info"> Producto: </th> 
                                <th class="border border-info"> N° orden: </th> 
                                <th class="border border-info"> Precio: </th> 
                                <th class="border border-info"> Cant: </th> 
                                <th class="border border-info"> Subtotal: </th> 
                                <th class="border border-info"> Info Envio: </th> 
                            </tr>
                        </thead>
            <?php while ($row = $resulset->fetch_assoc()) { ?>
                
                        <tr class="linea bg-dark text-secondary bg-dark">
                            <td class="border border-info"> <?php echo $row['usuario']; ?> </td>
                            <td class="border border-info"> <?php echo $row['nombreLibro']; ?> </td>
                            <td class="border border-info"> #APPR<?php echo $row['order_id']; ?> </td>
                            <td class="border border-info"> $<?php echo number_format($row['precioLibro']); ?> COP </td>
                            <td class="border border-info"> <?php echo $row['quantity']; ?> </td>
                            <td class="border border-info"> $<?php echo number_format($row['precioLibro']*$row['quantity']); ?> COP </td>
                            <td class="border border-info"> 
                                <button type="button" class="btn rounded p-2 pe-3 ps-3" data-bs-toggle="modal" data-bs-target="#infoEnvio"> Info Envio.. </button>     
                            </td>
                        </tr>
            
    <!-- Inicio Modal  -->
        <div class="modal fade text-center bg-dark bg-opacity-75" id="infoEnvio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="infoEnvio" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-light bg-opacity-75 mt-3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 h3 mx-auto" id="infoEnvio"> Información de envío </h1>
                        <div class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
                    </div>
                    <div class="modal-body text-start p-5 h4 fw-normal text-dark">
                        <p>
                            <b>Nombre: </b> <?php echo $row['name']; ?> <br>
                            <b>Telefono: </b> <?php echo $row['phone']; ?> <br>
                            <b>Dirección: </b> <?php echo $row['address']; ?> <br>
                            <b>Ciudad: </b> <?php echo $row['ciudad']; ?> <br>
                            <b> Información Adicional: </b> <?php echo $row['masInf']; ?> <br>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary border border-primary rounded fw-normal"  data-bs-dismiss="modal"> Cerrar </button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin Modal  -->
    <?php } ?>

    </table>
            </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../../js/jquery-3.6.1.min.js"> </script>  
    <script>
        $(document).ready(function(){
            $(".linea").mouseover(function(){
                $(this).attr("class", "bg-primary text-white bg-opacity-75");
            });
            $(".linea").mouseout(function() {
                $(this).attr("class", "bg-dark text-secondary bg-dark p-0");
            });
        })
    </script>
</body>
</html>