<?php
    include '../../controller/conexion.php';

    $con = new Configuracion;
    $conexion = $con->conectarDB();
    
    $busqueda = $_GET["parametro"];
    $busqueda = mysqli_real_escape_string($conexion, $busqueda);
    
    $limite = 6;
    $paginaActual = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
    
    $queryTotal = "SELECT COUNT(s.idForo) AS total FROM usuario u, foro f, (SELECT f.id AS idForo, COUNT(r.idForo) AS cantidad FROM respuestas r RIGHT JOIN foro f ON r.idForo = f.id WHERE f.idEstado = 1 AND (nombreLibro LIKE '%$busqueda%' OR autorLibro LIKE '%$busqueda%') GROUP BY f.id) s WHERE u.idUsuario = f.idUsuario AND s.idForo = f.id";
    $resultadoTotal = mysqli_query($conexion, $queryTotal);
    $rowTotal = mysqli_fetch_assoc($resultadoTotal);
    $totalFilas = $rowTotal['total'];
    $totalPaginas = ceil($totalFilas / $limite);
    
    $offset = ($paginaActual - 1) * $limite;
    
    $query = "SELECT s.idForo, f.idUsuario, f.nombreLibro, f.autorLibro, u.usuario, s.cantidad
                FROM usuario u, foro f, (
                                            SELECT f.id AS idForo, COUNT(r.idRespuesta) AS cantidad, u.usuario AS usuario
                                            FROM respuestas r
                                            RIGHT JOIN foro f ON r.idForo = f.id 
                                            JOIN usuario u ON f.idUsuario = u.idUsuario
                                            WHERE f.idEstado = 1 AND (nombreLibro LIKE '%$busqueda%' OR autorLibro LIKE '%$busqueda%' OR u.usuario LIKE '%$busqueda%') 
                                            GROUP BY f.id
                                        ) s 
                WHERE u.idUsuario = f.idUsuario AND s.idForo = f.id
                LIMIT $offset, $limite";

    
    $result = mysqli_query($conexion, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $idUsuario = $row['usuario'];
            $titulo = $row['nombreLibro'];
            $autor = $row['autorLibro'];
            $respuestas = $row['cantidad'];
            $id = $row['idForo'];

            echo "<div class='row mt-3 forum-card'>
                <div class='col-12'>
                    <a href='../foros/foro.php?id=" . $id . "'>
                        <div class='card'>
                            <div class='card-body d-flex justify-content-between'>
                                <div class='col-5'>
                                    <h5 class='card-subtitle mb-2'>Creador: " . $idUsuario . "</h5 style=' font-size: 16px;'>
                                    <h4 class='card-text mb-2'>" . $titulo . "</h4>
                                    <p class='card-tittle mb-0' style='opacity: 0.7;'>" . $autor . "</p>
                                </div>
                                <div class='col-6 d-flex flex-row-reverse align-items-center text-dark'>
                                    <span class='card-text mb-0' style='font-size: 1.2rem;'><i class='bi bi-chat-left' style='font-size: 1.4rem;'></i>  &nbsp; " . $respuestas . "</span>
                                    <img class='libroE me-4' src='https://img.icons8.com/ios-glyphs/30/null/open-book--v2.png'/>
                                </div>
                                <div class='col-1 d-flex align-items-center justify-content-center'>
                                    <!-- Columna vacía para centrar el contenido -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>";
        } $filas = mysqli_fetch_all($resultadoTotal, MYSQLI_ASSOC);

        ?>

        <div class="container mt-5 text-center">
            <ul class="pagination justify-content-center">
                <?php  if($paginaActual > 1): ?>
                    <li class="page-item me-3">
                        <a class="rounded btn btn-outline-primary border border-primary btn-sm" href="foros.php?p=<?php echo $paginaActual-1; ?>"> Anterior </a>
                    </li>
                <?php endif ?>
                
                <?php
                    if ($totalFilas > ($paginaActual * $limite) - $limite + count($filas)) :
                        for ($pagina = 1; $pagina <= $totalPaginas; $pagina += 1) :
                ?>
                            <li class="page-item me-2"><a class="btn btn-outline-primary border border-primary btn-sm rounded-pill" href="foros.php?p=<?php echo $pagina ?>"><?php echo $pagina ?></a></li>
                <?php
                        endfor;
                    endif;
                ?>

                <?php if ($paginaActual < $totalPaginas) : ?>
                    <li class="page-item ms-2">
                        <a class="btn btn-outline-primary border border-primary btn-sm rounded" href="foros.php?p=<?php echo $paginaActual + 1; ?>">
                            Siguiente
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </div>


    <?php
        echo '
        <script>
            var icono = $(".libroE");
            icono.hover(function() {
                $(this).attr("src", "../../img/iconos/libro-abierto.gif");
            }, function() {
                $(this).attr("src", "https://img.icons8.com/ios-glyphs/30/null/open-book--v2.png");
            });
        </script>';
    } else {
        echo "<h5 class= 'text-center mx-auto'> No se encontraron resultados</h5>";
    }
    $conexion = $con->cerrarConexion();
    unset($conexion);

?>