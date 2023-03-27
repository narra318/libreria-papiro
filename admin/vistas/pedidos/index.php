<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['Admin'])){
        header('Location: ../../index.php');
    }
?>

<!DOCTYPE html>
<html  lang="es">
<head>
    <title> Pedidos </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Pagina para ver las ventas y/o pedidos">
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

    <?php
        if(isset($_SESSION["actualizadoF"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> Exito:</strong> ';
            echo $_SESSION["actualizadoF"];
            echo '</div>';
            unset($_SESSION['actualizadoF']);
        }
    ?>

    <div class="container mt-5">
        <p id="Titulo3" class="text-center"> Todos los pedidos: </p>

        <div class="overflow-auto">
        <table class="table overflow-auto" id="usuarios" class="display">
            <thead>
                <tr class="text-white bg-info bg-opacity-75 text-center"> 
                    <th class="border border-info  text-center"> N° compra </th>
                    <th class="border border-info  text-center"> Usuario </th>
                    <th class="border border-info  text-center"> Total </th>
                    <th class="border border-info  text-center"> Estado </th>
                    <th class="border border-info  text-center"> Fecha </th>
                    <th class="border border-info  text-center">  </th>
                </tr>
            </thead>
    <?php
        include "../../codigo/controller/conexion.php";
        $con = new Configuracion;
        $conexion = $con->conectarDB();
    
        $sql = "SELECT orden.id, orden.customer_id, orden.total_price, orden.created, orden.status, usuario.usuario
            FROM orden 
            INNER JOIN clientes ON orden.customer_id = clientes.id
            INNER JOIN usuario ON clientes.idUsuario = usuario.idUsuario;";
    
        $orden = mysqli_query($conexion, $sql);
        
        while ($fila = mysqli_fetch_array($orden)) {
            $id = $fila['id'];
            $usuario = $fila['usuario'];
            $total = number_format($fila['total_price']);
            $fecha = date("d/m/Y", strtotime($fila['created']));
            $estado = $fila['status'];
            if($estado == 1){
                $estado = "Sin enviar &nbsp; <i class= 'bi bi-x-circle'></i";
            }else{
                $estado = "Entregado &nbsp; <i class= 'bi bi-check2-circle'></i";
            }
            
            echo "<tr class='linea bg-dark text-secondary bg-dark'>
            <td class='border border-info text-center '> #APPR".$id." </td>
            <td class='border border-info text-center'> ".$usuario." </td>
            <td class='border border-info text-center'> $".$total." COP </td>
            <td class='border border-info text-center' id='Link'> <a href='estado.php?id=".$id."'> $estado > </a> </td>
            <td class='border border-info text-center'> ".$fecha." </td>
            <td class='border border-info text-center' id='Link'> <a href='detalle.php?id=".$id."'> <i class= 'bi bi-eye'></i> </a> </td>
            </tr>";
        }
    ?>
        </table>
        </div>
    </div>

    
        <script src="../../../js/bootstrap.bundle.min.js"> </script>
        <script src="../../../js/jquery-3.6.1.min.js"> </script>
        <script src="../../../js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#usuarios').DataTable({
                    paging: true,
                    ordering: true,
                    info: true,
                });

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