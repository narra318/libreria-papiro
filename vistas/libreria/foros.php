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
    <meta name="description" content="Se puede encontrar foros creados por los usuarios sobre diferente material de lectura">
    <link rel="apple-touch-icon" href="../../img/icono2.png">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
    <link href="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
        #volver-a-foros {
            display: none;
        }

        #barra-busqueda {
            height: 50px;
            margin-top: 20px;
        }

        .forum-card:hover{
            cursor: pointer;
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

    <div class="container pb-4">
        <h1 id="Titulo1" class="mt-5 text-center"> Foros </h1>
        <div id="crearForo" class="text-end mt-4 overflow-auto">
            <a type="button" href="../../vistas/foros/formulario.php" class="btn btn-outline-primary border border-primary rounded me-3">
                Crear foro 
            </a>
        </div>
        <div class="container mb-2">
            <div class="form-floating mt-4">
                <input type="text" class="form-control bg-white text-primary rounded text-center" name="buscar" id="buscar" placeholder=" ">
                <label for="buscar" class="text-center text-info">Escriba el nombre o autor del libro que desea buscar </label>
            </div>
        </div>

        <div class="container">
            <div id="tablaForo">
                <?php
                    include_once "../../controller/conexion.php";
                    $con = new Configuracion;
                    $conexion = $con->conectarDB();
                    
                    $query = "SELECT s.idForo, f.idUsuario, f.nombreLibro, f.autorLibro, u.usuario, s.cantidad
                    FROM usuario u, foro f, (SELECT f.id as idForo, COUNT(r.idForo) as cantidad
                        FROM respuestas r RIGHT JOIN foro f ON r.idForo = f.id
                        WHERE f.idEstado = 1
                        GROUP BY f.id
                        ORDER BY id DESC) s
                    WHERE u.idUsuario = f.idUsuario
                    AND s.idForo = f.id";
                
                    $result = mysqli_query($conexion, $query);
                    $totalFilas = mysqli_num_rows($result);
                    
                    $limite = 6;
                    $paginaActual = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
                    
                    $totalPaginas = ceil($totalFilas / $limite);
                    $offset = ($paginaActual - 1) * $limite;
                    
                    $queryLimit = $query . " LIMIT $offset, $limite";
                    $resultLimit = mysqli_query($conexion, $queryLimit);
                    
                    while ($row = mysqli_fetch_array($resultLimit, MYSQLI_ASSOC)) {
                        $id = $row['idForo'];
                        $idUsuario = $row['usuario'];
                        $titulo = $row['nombreLibro'];
                        $autor = $row['autorLibro'];
                        $respuestas = $row['cantidad'];
                ?>
                    <div class="row mt-3 forum-card">
                        <div class="col-12">
                            <a href="../foros/foro.php?id=<?php echo $id; ?>" class="carta">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-between">
                                        <div class="col-5">
                                            <h5 class="card-subtitle mb-2">Creador: <?php echo $idUsuario; ?></h5 style=" font-size: 16px;">
                                            <h4 class="card-text mb-2"><?php echo $titulo; ?></h4>
                                            <p class="card-tittle mb-0" style="opacity: 0.7;"><?php echo $autor; ?></p>
                                        </div>
                                        <div class="col-6 d-flex flex-row-reverse align-items-center text-dark">
                                            <span class="card-text mb-0" style="font-size: 1.2rem;"><i class="bi bi-chat-left" style="font-size: 1.4rem;"></i>  &nbsp; <?php echo $respuestas; ?></span>
                                            <img class="libroE me-4" src="https://img.icons8.com/ios-glyphs/30/null/open-book--v2.png"/>
                                        </div>
                                        <div class="col-1 d-flex align-items-center justify-content-center">
                                            <!-- Columna vacía para centrar el contenido -->
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } $filas = mysqli_fetch_all($resultLimit, MYSQLI_ASSOC);?>

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
            </div>
        </div>

    </div>

    <script src="../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../js/jquery-3.6.1.min.js"> </script>
    <script>

        $(document).ready(function() {
            var carta = $(".carta");
            carta.hover(function() {
                var icono = $(this).find(".libroE");
                icono.attr("src", "../../img/iconos/libro-abierto.gif");
            }, function() {
                var icono = $(this).find(".libroE");
                icono.attr("src", "https://img.icons8.com/ios-glyphs/30/null/open-book--v2.png");
            });
            
            var busqueda = $('#buscar')
            var datos = $('#tablaForo')
            busqueda.on('keyup', function() {
                var valor = $(this).val();
                console.log("TEST");
                $.ajax({
                    type: "get",
                    url: "buscar.php",
                    data: {
                        parametro: valor
                    },
                    success: function(data) {
                        datos.html(data);
                    }
                });
            });
            
        });
    </script>
    <div> <?= footer(); ?> </div>
</body>

</html>