<?php
    ob_start();
    session_start();
    if (!isset($_SESSION['Admin'])) {
        header('Location: ../../index.php');
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Añadir Editorial </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../../css/custom.css">
    <link rel="stylesheet" href="../../../css/style2.css">
    <link rel="stylesheet" href="../../../css/jquery.dataTables.min.css">
    <link href="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../../../img/fondos/fondo-admin.jpg');
            background-size: 100%;
        }
    </style>
</head>

<body class="bg-dark">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menuAdmin("../../../"); ?>

    <?php

    include "../../../controller/conexion.php";
    $conn = new Configuracion();
    $con = $conn->conectarDB();
    ?>
    <div class="container-fluid p-5">
        <div class="float-end me-5">
            <?php include "../inventario/sidebar.php" ?>
        </div>
    </div>
    <div class="container-fluid justify-content-center">
        <h1 id="Titulo3" class="text-center mt-5"> Agregar editorial</h1>
        <div class="row justify-content-center">
            <div class=" col-md-12 p-5 justify-content-center">

                <form action="../../codigo/inventario/editorial.php" method="POST" class="">
                    <div class="form-floating m-4 mx-auto" style="width: 50%;">
                        <input type="text" placeholder="Ingrese el nombre del producto" name="nueva-editorial" id="nueva-editorial"  minlength="3" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$"  class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                        <label for="nueva-editorial" class="text-light">Ingrese una nueva editorial</label>
                        <?php
                            if(isset($_SESSION["ErrorDB"])){
                                echo '<div class="alert alert-warning m-0 alert-dismissible fade show">
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                                    <i class="bi bi-exclamation-circle"></i> <strong> Error:</strong> ';
                                echo $_SESSION["ErrorDB"];
                                echo '</div>';
                                unset($_SESSION['ErrorDB']);
                            }
                        ?>
                    </div>
                    <div class="text-center m-4">
                        <button type="submit" class="btn btn-light border rounded">Agregar editorial</button>
                        <a type="button" id="regresar" name="regresar" href="agregar-producto.php" class="btn btn-light border border-light rounded"> Volver </a>
                    </div>
                </form>
                <div class="container overflow-auto p-4 pt-0 w-50 text-white"> <br><br>
                    <table class="table overflow-auto  mx-auto" id="tabla">
                        <thead>
                            <tr class="text-white bg-info bg-opacity-75 text-center"> 
                                <th class="border border-info"> ID </th>
                                <th class="border border-info"> Nombre </th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM editorial ORDER BY idEditorial ASC;";

                            $productos = mysqli_query($con, $sql);
                            
                            while ($fila = mysqli_fetch_array($productos)) {
                                $id = $fila['idEditorial'];
                                $nombre = $fila['nombreEditorial'];
                                
                                echo "<tr class='linea bg-dark text-secondary'>
                                    <td class='border border-info text-center'> ".$id." </td>
                                    <td class='border border-info'> ".$nombre." </td>
                                </tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../../js/jquery-3.6.1.min.js"> </script>
    <script src="../../../js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tabla').DataTable({
                paging: true,
                ordering: true,
                info: false,
            });
        });
    </script>
</body>
</html>