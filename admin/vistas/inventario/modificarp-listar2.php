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
    <title> Modificar Productos </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Pagina para modificar los productos registrados, ya sea para inhabilitarlo o cambiar otro dato, aplica a empleado o cliente.">
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
<body class="bg-dark mb-5">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menuAdmin("../../../"); ?>

    <?php
        
        if(isset($_SESSION["actualizadoI"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> Exito:</strong> ';
            echo $_SESSION["actualizadoI"];
            echo '</div>';
            unset($_SESSION['actualizadoI']);
        }
    ?>

    <div class="container mt-5 overflow-auto">
        <p id="Titulo3" class="text-center"> Modificar Productos </p>
        <p class="text-white text-center"> Por favor seleccione un producto </p>
        <table class="table overflow-auto" id="usuarios">
            <thead>
                <tr class="text-white bg-info bg-opacity-75 text-center"> 
                    <th class="border border-info"> ID </th>
                    <th class="border border-info"> Imagen </th>
                    <th class="border border-info"> Nombre </th>
                    <th class="border border-info"> Autor </th>
                    <th class="border border-info"> Precio </th>
                    <th class="border border-info"> Cantidad </th>
                    <th class="border border-info"> Editorial </th>
                    <th class="border border-info"> ISBN </th>
                    <th class="border border-info"> Estado </th>
                    <th class="border border-info">  </th>
                </tr>
            </thead>
    <?php
        include "../../codigo/controller/conexion.php";
        $con = new Configuracion;
        $conexion = $con->conectarDB();

        $sql = "SELECT * FROM libro 
            INNER JOIN pais ON libro.idPais = pais.idPais
            INNER JOIN editorial ON libro.idEditorial = editorial.idEditorial  
            INNER JOIN tematica ON libro.idTematica = tematica.idTematica  
            INNER JOIN categoria ON libro.idCategoria = categoria.idCategoria   
            INNER JOIN estado ON libro.idEstado = estado.idEstado;";

        $productos = mysqli_query($conexion, $sql);
        
        while ($fila = mysqli_fetch_array($productos)) {
            $idLibro = $fila['idLibro'];
            $nombre = $fila['nombreLibro'];
            $autor = $fila['autor'];
            $precio = $fila['precioLibro'];
            $cantidad = $fila['cantidad'];
            $img = $fila['img'];
            $editorial = $fila['nombreEditorial'];
            $pag = $fila['paginas'];
            $pub = $fila['publicacion'];
            $pais = $fila['nombrePais'];
            $tematica = $fila['tematica'];
            $isbn = $fila['ISBN'];
            $categoria = $fila['categoria'];
            $estado = $fila['estado'];
            
            echo "<tr class='linea bg-dark text-secondary bg-dark'>
                <td class='border border-info'> ".$idLibro." </td>
                <td class='border border-info text-center'> <img src='../../codigo/inventario".$img."' alt='".$nombre."' style='min-width: 50px; width: 50px; min-height: 50px;'>  </td>
                <td class='border border-info'> ".$nombre." </td>
                <td class='border border-info'> ".$autor." </td>
                <td class='border border-info'> $".number_format($precio)." </td>
                <td class='border border-info text-center'> ".$cantidad." </td>
                <td class='border border-info'> ".$editorial." </td>
                <td class='border border-info'> ".$isbn." </td>
                <td class='border border-info'> ".$estado." </td>
            <td class='border border-info' id='Link'> <a href='../../codigo/inventario/modificar.php?id=".$idLibro."'> Editar <i class='bi bi-pencil'> </i> </a> </td>
            </tr>";
            
        }


    ?>
        </table>
    </div>

    <?php
        // Consulta para obtener las órdenes
        $consulta = "SELECT * FROM orden";
        $resultado = mysqli_query($conexion, $consulta);

        // Generar la tabla con los datos de las órdenes
        echo "<table>";
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['customer_id'] . "</td>";
            // Agregar más campos de la orden que desees mostrar en la tabla
            echo "<td><button class='ver-mas' data-id='" . $row['id'] . "'>Ver más</button></td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($conexion);   

        // $idOrden = $_POST['id'];
    ?>

    <!-- Modal para mostrar la información del pedido -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Detalles del pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="text-black"> Holaaaaaaaaaaa </div>
                        <div id="id_compra"> </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal fin -->

    <?php   
    ?>
        
    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../../js/jquery-3.6.1.min.js"> </script>
    <script src="../../../js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            var  idComp = $('#id_compra');

            $(".ver-mas").on("click", function() {
                var idOrden = $(this).data("id");

                $.ajax({
                    url: "modificarp-listar2.php",
                    type: "POST",
                    data: { id: idOrden },
                    success: function(response) {
                        idComp.text(idOrden);
                        // $("#modal-body").html(response);
                        $("#modal").modal("show");
                    }
                });
            });

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