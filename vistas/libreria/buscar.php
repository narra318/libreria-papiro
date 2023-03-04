<?php
include '../../controller/conexion.php';

$conexion = new Configuracion();
$con = $conexion->conectarDB();

$registros_por_pagina = 3;

$buscar = '';
if (isset($_GET['pagina'])) {
    $pagina_actual = $_GET['pagina'];
    $buscar = mysqli_real_escape_string($con, $buscar);
} else {
    $pagina_actual = 1;
}

$registro_inicial = ($pagina_actual - 1) * $registros_por_pagina;

$consulta = "SELECT * FROM foro 
            INNER JOIN usuario ON foro.idUsuario = usuario.idUsuario
            INNER JOIN estado ON foro.idEstado = estado.idEstado
            WHERE foro.identificador = 0 AND estado.idEstado=1 AND nombreLibro LIKE '%$buscar%'
            ORDER BY id DESC
            LIMIT $registro_inicial, $registros_por_pagina";


$resultado = $con->query($consulta);

if (!$resultado) {
    echo "Error al ejecutar la consulta: " . mysqli_error($con);
}

if (mysqli_num_rows($resultado) > 0) {

    include '../../modules/menu-footer.php';
    
    
    echo '<div class="p-5" id="resultados">  <div class="table-responsive">
                <table class="table table-striped" style="max-width: 100%;">
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

    // Agregar sección de enlaces para la paginación
    $total_registros = mysqli_num_rows(mysqli_query($con, "SELECT * FROM foro WHERE identificador = 0"));
    $total_paginas = ceil($total_registros / $registros_por_pagina);
    $url = $_SERVER['PHP_SELF'] . "?pagina=";
    echo "<nav aria-label='Pagina de navegacion'>";
        echo "<ul class='pagination justify-content-center'>";
        for ($i = 1; $i <= $total_paginas; $i++) {
            echo "<li class='page-item'><a class='page-link' href='" . $url . $i . "'>" . $i . "</a></li>";
        }
        echo "</ul>";
    echo "</nav>";

    echo '<div class="p-5 pt-2 "> 
            <a href="http://localhost/Libreria/vistas/libreria/foros.php" id="volver-a-foros"> Volver a los foros </a>
          </div>';

    ?>
    
    <script>
        function buscar() {
            var busqueda = document.getElementById('busqueda').value;

            if (busqueda.trim() == "") {
                document.getElementById("resultados").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("resultados").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "resultados.php?busqueda=" + busqueda, true);
                xmlhttp.send();
            }
        }
    </script>
<?php
    if ($buscar == "") {
        echo ' </body></html>';
    } else {
        echo "<h1 class='text-center'>No se encontraron resultados para la búsqueda: " . $buscar . "</h1>";
    };
}
?>