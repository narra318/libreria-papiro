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
    <title> Añadir Tematica </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../../css/custom.css">
    <link rel="stylesheet" href="../../../css/style2.css">
    <link href="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/jquery.dataTables.min.css">
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
    
    if(isset($_SESSION["ErrorDB"])){
        echo '<div class="alert alert-success m-0 alert-dismissible fade show">
            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            <strong> Exito:</strong> ';
        echo $_SESSION["ErrorDB"];
        echo '</div>';
        unset($_SESSION['ErrorDB']);
    }

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
        <h1 id="Titulo3" class="text-center mt-5">Agregar tematica</h1>
        <div class="row justify-content-center">
            <div class=" col-md-12 p-5 justify-content-center">

                <form action="../../codigo/inventario/tematica.php" method="POST">
                    <div class="form-floating m-4 mx-auto" style="width: 50%;">
                        <input type="text" placeholder="Ingrese el nombre del producto" name="nueva-tematica" id="nueva-tematica" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                        <label for="nueva-tematica" class="text-light">Ingrese una nueva Tematica</label>
                    </div>
                    <div class="text-center m-4">
                        <button type="submit" class="btn btn-light border rounded">Agregar Tematica</button>
                        <a type="button" id="regresar" name="regresar" onclick="history.back()" class="btn btn-light border border-light rounded"> Volver </a>
                    </div>
                </form>

                <div class="container overflow-auto p-4 pt-0 text-white w-50"> 
                    <br><br>
                    <!-- <p class="text-center fw-bold bg-dark w-25 mx-auto"> Las tematicas actuales son:  </p> -->

                    <table class="table overflow-auto mx-auto" id="tabla">
                        <thead>
                            <tr class="text-white bg-info bg-opacity-75 text-center"> 
                                <th class="border border-info"> ID </th>
                                <th class="border border-info"> Nombre </th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM tematica ORDER BY idTematica ASC;";

                            $productos = mysqli_query($con, $sql);
                            
                            while ($fila = mysqli_fetch_array($productos)) {
                                $id = $fila['idTematica'];
                                $nombre = $fila['tematica'];
                                
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