<?php
    ob_start();
    session_start();
    if (!isset($_SESSION['Status'])) {
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Usuario </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Este pagina es la de inicio de los usuarios, donde podran revisar su información.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="apple-touch-icon" href="../../../img/icono2.png">
    <link rel="stylesheet" href="../../../css/custom.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/login_reg.css">
    <link href="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        .menu-side:hover {
            color: #ffffff;
            text-shadow: 0px 0px 20px #B9B4BF;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #88456a;
            color: #ffffff;
            text-shadow: 0px 0px 10px #ffffff;
        }
    </style>
</head>

<body class="bg-secondary" onload="hora()">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menu("../../.."); ?>

    <div class="row me-0">
        <div class="col-md-3"> <?= menuSide("active", "", "", "", "../../../"); ?> </div>
        <div class="col-md-9 ms-0 contenido" style="height: 100vh; overflow: auto;">

            <div class="container">

                <!-- Reloj Inicio -->
                <div class="mt-5">

                    <?php
                    date_default_timezone_set("America/Bogota");

                    $hora = date('h:i A');
                    strtotime($hora);

                    if (strtotime($hora) <= strtotime('12:00:00')) {
                        echo '<h3 class="text-start text-primary"> Buenos Días ' . $_SESSION["Status"] . ' </h3>';
                        echo "<p id='espacio' class='text-start'> <br>" . $hora;
                        echo "<br></p>";
                    } elseif (strtotime($hora) <= strtotime('19:00:00')) {
                        echo '<h3 class="text-center text-primary"> Buenas Tardes ' . $_SESSION["Status"] . ' </h3>';
                        echo "<p id='espacio' class='text-center'> <br>" . $hora;
                        echo "<br></p>";
                    } elseif (strtotime($hora) <= strtotime('23:59:59')) {
                        echo '<h3 class="text-end text-primary"> Buenas Noches ' . $_SESSION["Status"] . ' </h3>';
                        echo "<p id='espacio' class='text-end'> <br>" . $hora;
                        echo "<br></p>";
                    }

                    ?>
                </div>
                <!-- Reloj Fin -->
                <h2 id="Titulo1" class="text-center"> Mis Foros </h2>


            <?php
                include "../../../controller/conexion.php";
                $con = new Configuracion;
                $conexion = $con->conectarDB();
                $idd =  $_SESSION['idUsuario'];


                $query = "SELECT s.idForo, e.estado, f.idUsuario, f.nombreLibro, f.autorLibro, COALESCE(s.cantidad, 0) AS cantidad
                FROM usuario u
                INNER JOIN foro f ON f.idUsuario = u.idUsuario
                INNER JOIN estado e ON f.idEstado = e.idEstado
                LEFT JOIN (
                    SELECT f.id AS idForo, COUNT(r.idForo) AS cantidad
                    FROM foro f
                    LEFT JOIN respuestas r ON r.idForo = f.id
                    WHERE f.idEstado = 1 OR f.idEstado = 2
                    GROUP BY f.id
                ) s ON s.idForo = f.id
                WHERE u.idUsuario = $idd";

                $result = $conexion->query($query);

                if (!$result) {
                    die('Error en la consulta SQL: ' . mysqli_error($conexion));
                }

                if (mysqli_num_rows($result) > 0) {
            ?>

                <table class="table mt-5 mb-5 text-black" style="border: 1px solid purple;" width="620px">
                        <thead class=" h4 text-center" id="tablac">
                            <th width="20px" style="border-right: 1px solid purple;"> </th>
                            <th width="200px" style="border-right: 1px solid purple;"> Estado </th>
                            <th width="300px" style="border-right: 1px solid purple;">Libro</th>
                            <th width="200px" style="border-right: 1px solid purple;">Autor</th>
                            <th width="100px" style="border-right: 1px solid purple;">Respuestas</th>
                        </thead>
            <?php
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $id = $row['idForo'];
                        $estado = $row['estado'];
                        $titulo = $row['nombreLibro'];
                        $autor = $row['autorLibro'];
                        $respuestas = $row['cantidad'];

                        if ($estado == "Habilitado") {
                            $estado = "Publicado";
                            echo "<tr class='bg-success bg-opacity-50'>";
                        } elseif ($estado == "Inhabilitado") {
                            $estado = "En espera";
                            echo "<tr class='bg-warning bg-opacity-50'>";
                        }
                        
                        echo "<td style='border-right: 1px solid purple;' > <a href='../../foros/foro.php?id=$id'>Ver</a></td>";
                        echo "<td style='border-right: 1px solid purple;' > $estado </td>";
                        echo "<td style='border-right: 1px solid purple;' >$titulo</td>";
                        echo "<td style='border-right: 1px solid purple;' >$autor</td>";
                        echo "<td style='border-right: 1px solid purple;' >$respuestas</td>";
                        echo "</tr>";
                    }


                    
                } else {
                    echo "<h5 class='text-center mb-5'> Aún no has creado un foro</h5>";
                }

                ?>
                </table>
                <div class="text-end mb-5">
                    <a class="btn btn-primary rounded" type="button" href="../../../codigo/usuario/logout.php"> Cerrar Sesión </a>
                </div>
            
        </div>
        </div>
        
    </div>
    <?= footer(); ?>

    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../../js/jquery-3.6.1.min.js"> </script>
    <script>
        function hora() {
            const fecha = new Date();

            let H = fecha.getHours();
            let M = fecha.getMinutes();
            let S = fecha.getSeconds();

            H = (H < 10) ? "0" + H : H;
            M = (M < 10) ? "0" + M : M;
            S = (S < 10) ? "0" + S : S;

            var horaT = H + " : " + M + " : " + S;
            document.getElementById('espacio').innerHTML = horaT;

            setTimeout(hora, 1000);
        }
    </script>
</body>

</html>