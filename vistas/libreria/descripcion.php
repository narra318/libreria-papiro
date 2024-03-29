<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title id="Titulo"> Detalles del libro </title>
    <meta charset="UTF-8">
    <meta name="description" content="Página de descripcion de los libros del catalogo - libreria papiro">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-secondary">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v16.0" nonce="FuROFNPG"></script>

    <?php include '../../modules/menu-footer.php'; ?>
    <?= menu("../.."); ?>

    <div class="mt-3 container h-100" id="tarjeta">
        <div class="row mb-5 h-100">
            <?php
            include "../../controller/conexion.php";

            $conn = new Configuracion();
            $con = $conn->conectarDB();

            $id = $_GET['id'];
            $sql = "SELECT * FROM libro 
            INNER JOIN pais ON libro.idPais = pais.idPais  
            INNER JOIN editorial ON libro.idEditorial = editorial.idEditorial  
            INNER JOIN tematica ON libro.idTematica = tematica.idTematica  
            INNER JOIN categoria ON libro.idCategoria = categoria.idCategoria  
            where idLibro =$id AND idEstado='1'";

            $resulset = $con->query($sql);

            while ($row = $resulset->fetch_assoc()) {
                
            ?>
                <h1 id="Titulo1" class="mt-5 mb-2 text-center"> <?php echo $row['nombreLibro']; ?> </h1>
                <h2 id="Titulo4" class="mb-5 text-center"> <?php echo $row['autor']; ?> </h2>

                <div class="col-lg-3 mb-4 mt-4">
                    <div class="card bg-secondary bg-opacity-25">
                        <img class="card-img-top img-fluid" src="../../admin/codigo/inventario<?php echo $row['img']; ?>" alt="<?php echo $row['nombreLibro']; ?>">
                    </div>
                </div>   
                    
                <div class="col">
                    <div class="card pt-0 p-5 mt-4 bg-secondary border-secondary bg-opacity-50">
                        <div class="overflow-auto">
                            <table class="table border border-primary text-center text-primary">
                                <tr> 
                                    <th class="border border-primary"> ISBN: </th> 
                                    <th class="border border-primary"> Editorial: </th> 
                                    <th class="border border-primary"> Paginas: </th> 
                                    <th class="border border-primary"> Año: </th> 
                                    <th class="border border-primary"> País: </th> 
                                    <th class="border border-primary"> Tematica: </th> 
                                    <th class="border border-primary"> Categoria: </th> 
                                </tr>
                                <tr>
                                    <td class="border border-primary"> <?php echo $row['ISBN']; ?> </td>
                                    <td class="border border-primary"> <?php echo $row['nombreEditorial']; ?> </td>
                                    <td class="border border-primary"> <?php echo $row['paginas']; ?> </td>
                                    <td class="border border-primary"> <?php echo $row['publicacion']; ?>  </td>
                                    <td class="border border-primary">  <?php echo $row['nombrePais']; ?>  </td>
                                    <td class="border border-primary">  <?php echo $row['tematica']; ?>  </td>
                                    <td class="border border-primary"> <?php echo $row['categoria']; ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="card-text text-primary pt-2 pb-3" style="text-align:justify; color: #26111D;"><?php echo $row['descripcionLibro']; ?></div>
                        <p class="card-text" style="font-size:25px;"><span class="text-info"><b>Precio: $<?php echo number_format($row['precioLibro']); ?></b> </span></p>
                        <p class="card-text" style="font-size:25px;">  </p>
                        
                        <form action="cart.php" method="post" id="formulario" name="formulario">
                            <input type="hidden" name="id" id="id" value="<?php echo $row['idLibro'] ?>">
                            <input type="hidden" name="img" id="img" value="<?php echo $row['img'] ?>">
                            <input type="hidden" name="titulo" id="titulo" value="<?php echo $row['nombreLibro'] ?>">
                            <input type="hidden" name="autor" id="autor" value="<?php echo $row['autor'] ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo $row['precioLibro'] ?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="1">

                            <div class="text-end">
                                <a class="btn btn-outline-primary border border-primary rounded" onclick="history.back()" type="button"> Volver </a>
                                <a class="btn btn-primary rounded" href="../../carrito/AccionCarta.php?action=addToCart&id=<?php echo $row["idLibro"]; ?>">Añadir <i class="bi bi-cart-plus"></i> </a>
                            </div>
                        </form>
                    </div>
                </div>


            <?php
            } // endwhile
            ?>
            <br>

            <div class="fb-comments mt-3" data-href="https://libreria-papiro.000webhostapp.com/descripcion.php?id=<?php echo $id; ?>" data-width="1100" data-numposts="5" data-colorscheme="dark"></div>
        </div>
        </div>


    <?= footer(); ?>
    <script src="../../js/bootstrap.bundle.min.js"> </script>
</body>
</html>