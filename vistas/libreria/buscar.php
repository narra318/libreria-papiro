<?php
    include '../../controller/conexion.php';

    $conexion = new Configuracion();
    $con = $conexion->conectarDB();

    $registros_por_pagina = 3;

    $buscar = '';
    if (isset($_GET['pagina'])) {
        $pagina_actual = $_GET['pagina'];
        $buscar = mysqli_real_escape_string($con, $buscar);
    }

    // $registro_inicial = ($pagina_actual - 1) * $registros_por_pagina;

    $consulta = "SELECT * FROM foro 
                INNER JOIN usuario ON foro.idUsuario = usuario.idUsuario
                INNER JOIN estado ON foro.idEstado = estado.idEstado
                WHERE foro.identificador = 0 AND estado.idEstado=1 AND nombreLibro LIKE '%$buscar%'
                ORDER BY id DESC LIMIT 4";

    $resultado = $con->query($consulta);

    if (!$resultado) {
        echo "Error al ejecutar la consulta: " . mysqli_error($con);
    }

    if (mysqli_num_rows($resultado) > 0) {
        
        echo '<div class="p-5" id="resultados"> <div class="table-responsive">
                    <table class="table table-striped" id="tabla" style="max-width: 100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Creador</th>
                                <th>Libro</th>
                                <th>Autor</th>
                                <th>Respuestas</th>
                            </tr>
                        </thead>
                        <tbody>';

        while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $id = $row['id'];
            $idUsuario = $row['usuario'];
            $titulo = $row['nombreLibro'];
            $autor = $row['autorLibro'];
            $fecha = $row['fecha'];
            $respuestas = $row['respuestas'];

                    echo "<tr>";
                        echo "<td><a href='../foros/foro.php?id=$id'>Ver</a></td>";
                        echo "<td>$idUsuario</td>";
                        echo "<td>$titulo</td>";
                        echo "<td>$autor</td>";
                        echo "<td>$respuestas</td>";
                    echo "</tr>";
        }

                echo "</tbody>";
            echo "</table>";
        echo "</div>";

        echo '<div class="p-5 pt-2 "> 
                <a href="http://localhost/Libreria/vistas/libreria/foros.php" id="volver-a-foros"> Volver a los foros </a>
            </div>';

?>

<script>
    $(document).ready(function(){
        $('#tabla').DataTable({
            paging: true,
            ordering: true,
            info: true,
        });
    });
</script>

<?php        

        if ($buscar == "") {
            echo ' </body></html>';
        } else {
            echo "<h1 class='text-center'>No se encontraron resultados para la búsqueda: " . $buscar . "</h1>";
        };
    }
?>