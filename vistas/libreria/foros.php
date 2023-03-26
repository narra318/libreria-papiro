<?php
ob_start();
session_start();
if (!isset($_SESSION['Status'])) {
    $_SESSION['Foro2'] = "<script> alert('Por favor inicie sesión para ver los foros'); </script>";
    header('Location: ../../vistas/usuario/index.php');
}

if (isset($_SESSION['Foro'])) {
    echo $_SESSION['Foro'];
    unset($_SESSION["Foro"]);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Foros </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icono2.png" type="image/ico" />
    <link rel="apple-touch-icon" href="../../img/icono2.png">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        #volver-a-foros {
            display: none;
        }

        #barra-busqueda {
            height: 50px;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-secondary">
    <?php include '../../modules/menu-footer.php'; ?>
    <?= menu("../../"); ?>

    <?php
    if (isset($_SESSION['crearForo'])) {
        echo '<div class="alert alert-success m-0 alert-dismissible fade show">
                    <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                    <strong> Exito:</strong> ';
        echo $_SESSION["crearForo"];
        echo '</div>';

        unset($_SESSION['crearForo']);
    }
    ?>

    <div class="container">
        <h1 id="Titulo1" class="mt-5 text-center"> Foros </h1>
        <p id="" class="mt-2 text-center text-info"> Sistema de Intercambio de libros </p>

        <div class="titulo-barra">
            <?= BarraBusqueda() ?>
        </div>

        <div class="foros-container" id="foros-container">
            <div class="text-end mt-4"><a type="button" href="../../vistas/foros/formulario.php" class="btn btn-outline-primary border border-primary rounded"> Crear foro </a></div>
            <table id="tabla-foros" class="table mt-5 mb-5" width="620px">
                <tr>
                    <th width="20px"> </th>
                    <th width="200px"> Creador </th>
                    <th width="300px">Libro</th>
                    <th width="200px">Autor</th>
                    <th width="100px">Respuestas</th>
                </tr>
                <?php

                include_once "../../controller/conexion.php";
                $con = new Configuracion;
                $conexion = $con->conectarDB();

                    $query = "SELECT s.idForo, f.idUsuario, f.nombreLibro , f.autorLibro, u.usuario, s.cantidad
                    FROM usuario u, foro f, (SELECT  f.id as idForo,  COUNT(r.idForo) as cantidad
                    FROM respuestas r RIGHT JOIN foro f ON  r.idForo = f.id
                    WHERE f.idEstado = 1
                    GROUP BY f.id
                    ORDER BY id DESC) s 
                    WHERE u.idUsuario = f.idUsuario
                    AND s.idForo = f.id";
                $result = $conexion->query($query);
                
                $conexion = $con->cerrarConexion();
                unset($conexion);   
                unset($con);
     
                
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $id = $row['idForo'];
                    $idUsuario = $row['usuario'];
                    $titulo = $row['nombreLibro'];
                    $autor = $row['autorLibro'];
                    $respuestas = $row['cantidad'];
                    echo "<tr>";
                    echo "<td> <a href='../foros/foro.php?id=$id'>Ver</a></td>";    
                    echo "<td>$idUsuario</td>";
                    echo "<td>$titulo</td>";
                    echo "<td>$autor</td>";
                    echo "<td>$respuestas</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="p-5" id="resultados"> </div>
    <div class="p-5"> <a href="http://localhost/Libreria/vistas/libreria/foros.php" id="volver-a-foros">Volver a los foros</a>
    </div>

    <div> <?= footer(); ?> </div>

    <script src="../../js/bootstrap.bundle.min.js"> </script>
    <script>
        function buscar() {
            var busqueda = document.getElementById('busqueda').value;

            if (busqueda.trim() !== '') {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("resultados").innerHTML = this.responseText;
                        document.getElementById("tabla-foros").style.display = "none";
                        document.getElementById('volver-a-foros').style.display = 'inline';
                    }
                };
                xhttp.open("GET", "buscar.php?busqueda=" + busqueda, true);
                xhttp.send();
            } else {
                document.getElementById("busqueda").value = "";
                document.getElementById("resultados").innerHTML = "";
                document.querySelector(".tabla-foros").style.display = "none";
            }
        }
    </script>
</body>

</html>