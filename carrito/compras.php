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
    $con = $conexion->conectarDB();
    $usuarioId = $_SESSION['idUsuario'];

    $limite = 5;
    $paginaActual = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    $totalOrdenes = mysqli_num_rows(mysqli_query($con, "SELECT orden.id FROM orden INNER JOIN clientes WHERE clientes.idUsuario = '$usuarioId' AND orden.customer_id = clientes.id;"));
    $totalPaginas = ceil($totalOrdenes / $limite);

    $offset = ($paginaActual - 1) * $limite;

    $sql = "SELECT orden.id, orden.customer_id, orden.total_price, orden.created, orden.status 
    FROM orden INNER JOIN clientes
    WHERE clientes.idUsuario = '$usuarioId' AND orden.customer_id = clientes.id
    ORDER BY created DESC
    LIMIT $offset, $limite";

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
        <div class="col-md-3"> <?=  menuSide("", "","active","","../"); ?> </div>

        <div class="col-md-9 ms-0 sub-menu-cont" style="height: 100vh; overflow: auto;">
            <div class="container mt-5">
                <?php 
                    if (mysqli_num_rows($orden) == 0) {  
                        echo '
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h1 class="text-center mt-5 mb-5" id="Titulo1">Pedidos  <i class="bi bi-bag"></i>  </h1>
                            </div>
                        </div>
                        
                        <p class="text-center text-dark h3"> No se han realizado pedidos...</p>
                        
                        <div class="text-center mt-4"><br><a href="../vistas/libreria/catalogo.php" class="btn btn-primary rounded"> Ir al catalogo &nbsp;&nbsp; <i class="bi bi-journal"></i></a></div>
                        ';
                    }else{ 
                ?>
                
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
                    }

                    
                    $filas = mysqli_fetch_all($orden, MYSQLI_ASSOC);

                    ?>
                    <div class="container mt-5 text-center">
                        <ul class="pagination justify-content-center">
                            <?php  if($paginaActual > 1): ?>
                                <li class="page-item me-3">
                                    <a class="rounded btn btn-outline-primary border border-primary btn-sm" href="compras.php?p=<?php echo $paginaActual-1; ?>"> Anterior </a>
                                </li>
                            <?php endif ?>
                            
                            <?php
                                if ($totalOrdenes > ($paginaActual * $limite) - $limite + count($filas)) :
                                    for ($pagina = 1; $pagina <= $totalPaginas; $pagina += 1) :
                            ?>
                                        <li class="page-item me-2"><a class="btn btn-outline-primary border border-primary btn-sm rounded-pill" href="compras.php?p=<?php echo $pagina ?>"><?php echo $pagina ?></a></li>
                            <?php
                                    endfor;
                                endif;
                            ?>

                            <?php if ($paginaActual < $totalPaginas) : ?>
                                <li class="page-item ms-2">
                                    <a class="btn btn-outline-primary border border-primary btn-sm rounded" href="compras.php?p=<?php echo $paginaActual + 1; ?>">
                                        Siguiente
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
            </div>
        </div>
    </div>


<?= footer(); ?>    </div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>