<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['Admin'])){
        header('Location: ../../index.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title> Añadir Producto </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../../css/custom.css">
    <link rel="stylesheet" href="../../../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link href="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../../../img/fondos/fondo-admin.jpg');
            background-size: 100%;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance: none;
        }

        img {
            display: block;
            max-width: 100%;
        }
        .preview {
            overflow: hidden;
            width: 160px; 
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
</head>

<body class="bg-dark">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menuAdmin("../../../"); ?>

    <?php
        if(isset($_SESSION["Producto"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> Exito:</strong> ';
            echo $_SESSION["Producto"];
            echo '</div>';
            unset($_SESSION['Producto']);
        }

        
        if(isset($_SESSION["exito"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> Exito:</strong> ';
            echo $_SESSION["exito"];
            echo '</div>';
            unset($_SESSION["exito"]);
        }

        if(isset($_SESSION["ErrorDB"])){
            echo '<div class="alert alert-warning m-0 alert-dismissible text-center fade show">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> <i class="bi bi-exclamation-circle"></i> Error:</strong> ';
            echo $_SESSION["ErrorDB"];
            echo '</div>';
            unset($_SESSION['ErrorDB']);
        }

        if (isset($_SESSION["registro_data"])) { 
            $registro_data = $_SESSION["registro_data"];

            $nombre_value = isset($registro_data['nombre']) ? $registro_data['nombre'] : '';
            $autor_value = isset($registro_data['autor']) ? $registro_data['autor'] : '';
            $desc_value = isset($registro_data['descripcion']) ? $registro_data['descripcion'] : '';
            $precio_value = isset($registro_data['precio']) ? $registro_data['precio'] : '';
            $ISBN_value = isset($registro_data['ISBN']) ? $registro_data['ISBN'] : '';
            $paginas_value = isset($registro_data['paginas']) ? $registro_data['paginas'] : '';
            $cantidad_value = isset($registro_data['cantidad']) ? $registro_data['cantidad'] : '';
            $publicacion_value = isset($registro_data['publicacion']) ? $registro_data['publicacion'] : '';
            $editorial_value = isset($registro_data['editorial']) ? $registro_data['editorial'] : '';
            $categoria_value = isset($registro_data['categoria']) ? $registro_data['categoria'] : '';
            $tematica_value = isset($registro_data['tematica']) ? $registro_data['tematica'] : '';
            $pais_value = isset($registro_data['pais']) ? $registro_data['pais'] : '';
            $status_value = isset($registro_data['estado']) ? $registro_data['estado'] : '';
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
        <h1 id="Titulo3" class="text-center ms-5 mt-5">Agregar producto</h1>
        <p class="text-light text-center"> <i class="bi bi-danger"></i> Asegurese de revisar de antemano que la categoria, tematica y editorial ya esten registradas. </p>

        <div class="row justify-content-center">
            <div class=" col-md-6 p-5 justify-content-center">

                <form action="../../codigo/inventario/agregar.php" method="POST" enctype="multipart/form-data" id="form">
                    <div class="form-floating m-4">
                        <input type="text" value="<?php if (isset($_SESSION["registro_data"])) { echo $nombre_value; } ?>" maxlength="65" placeholder="Ingrese el nombre del producto" name="nombreProducto" id="nombreProducto" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                        <label for="nombreProducto" class="text-light">Nombre</label>
                    </div>

                    <div class="form-floating m-4">
                        <textarea name="descripcionProducto" id="descripcionProducto" cols="30" rows="10" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required style="height: 133px;"><?php if (isset($_SESSION["registro_data"])) { echo $desc_value; } ?></textarea>
                        <label for="descripcionProducto" class="text-light">Descripcion</label>
                    </div>

                    <div class="form-floating m-4">
                        <input type="number" value="<?php if (isset($_SESSION["registro_data"])) { echo $precio_value; } ?>" min="100" placeholder="Ingrese el precio del producto" name="precioProducto" id="precioProducto" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="precioProducto" class="text-light">Precio</label>
                    </div>
                    <div class="form-floating m-4">
                        <input type="text" value="<?php if (isset($_SESSION["registro_data"])) { echo $ISBN_value; } ?>" pattern="[0-9]+" minlength="10" maxlength="13" placeholder="Ingrese el ISBN del libro"  name="ISBN" id="ISBN" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="ISBN" class="text-light">ISBN</label>
                    </div>
                    
                    <div class="row m-4 ms-3 me-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" value="<?php if (isset($_SESSION["registro_data"])) { echo $paginas_value; } ?>" placeholder="Ingrese el número de páginas" min="1" name="n-paginas" id="n-paginas" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                                <label for="n-paginas" class="text-light">Número de Páginas</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" value="<?php if (isset($_SESSION["registro_data"])) { echo $cantidad_value; } ?>" min="1" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                                <label for="cantidad" class="text-light">Cantidad</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating m-4">
                        <select name="editorial" id="editorial" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                            <option >Seleccione editorial</option>
                            <?php
                            $sql5 = "SELECT * from editorial ORDER BY idEditorial ASC";
                            $resultado_consulta_mysql = mysqli_query($con, $sql5);

                            while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                                $idEditorial = $fila['idEditorial'];
                                $nombreEditorial = $fila['nombreEditorial'];
                                if ($idEditorial == $editorial_value) {
                                    echo "<option value='" . $idEditorial . "' selected> " . $nombreEditorial . "</option>";
                                } else {
                                    echo "<option value='" . $idEditorial . "'> " . $nombreEditorial . "</option>";
                                }
                            }
                            echo "</select>";
                            ?>
                        </select>
                    </div>
            </div>
            <div class="col-md-6 p-5 justify-content-center">
                <div class="form-floating m-4">
                    <input type="text" value="<?php if (isset($_SESSION["registro_data"])) { echo $autor_value; } ?>" maxlength="60" placeholder="Ingrese el número de páginas" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" name="autor" id="autor" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                    <label for="n-paginas" class="text-light">Autor(a)</label>
                </div>

                <div class="form-floating m-4">
                    <select name="categoria" id="categoria" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                        <option>Seleccione la categoria</option>
                        <?php
                        $sql3 = "SELECT * from categoria ORDER BY categoria ASC";
                        $resultado_consulta_mysql = mysqli_query($con, $sql3);

                        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                            $idCategoria = $fila['idCategoria'];
                            $nombreCategoria = $fila['categoria'];
                            if ($idCategoria == $categoria_value) {
                                echo "<option value='" . $idCategoria . "' selected> " . $nombreCategoria . "</option>";
                            } else {
                                echo "<option value='" . $idCategoria . "'> " . $nombreCategoria  . "</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                    </select>
                </div>
                <div class="form-floating m-4">
                    <select name="tematica" id="tematica" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                        <option>Seleccione la tematica</option>
                        <?php
                        $sql4 = "SELECT * from tematica ORDER BY tematica ASC";
                        $resultado_consulta_mysql = mysqli_query($con, $sql4);

                        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                            $idTematica = $fila['idTematica'];
                            $nombreTematica = $fila['tematica'];
                            if ($idTematica == $tematica_value) {
                                echo "<option value='" . $idTematica . "' selected> " . $nombreTematica . "</option>";
                            } else {
                                echo "<option value='" . $idTematica . "'> " . $nombreTematica  . "</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                    </select>
                </div>
                <div class="form-floating m-4">
                    <input type="number" value="<?php if (isset($_SESSION["registro_data"])) { echo $publicacion_value; } ?>" min="1000" placeholder="Ingrese el número de páginas" name="publicacion" id="publicacion" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light ">
                    <label for="publicacion" class="text-light">Año de Publicación</label>
                </div>
                <div class="form-floating m-4">
                    <select name="pais" id="pais" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light">
                        <option> Selecione el pais</option>
                        <?php


                        $sql2 = "SELECT * from pais ORDER BY nombrePais ASC";
                        $resultado_consulta_mysql = mysqli_query($con, $sql2);

                        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                            $idPais = $fila['idPais'];
                            $nombrePais = $fila['nombrePais'];
                            if ($idPais == $pais_value) {
                                echo "<option value='" . $idPais . "' selected> " . $nombrePais . "</option>";
                            } else {
                                echo "<option value='" . $idPais . "'> " . $nombrePais  . "</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                        <label for="pais">Nombre del pais</label>
                </div>

                <div class="form-floating m-4">
                    <select name="estado" id="estado" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                        <option">Seleccione el estado</option>
                        <?php
                        $sql6 = "SELECT * from estado ORDER BY idEstado ASC";
                        $resultado_consulta_mysql = mysqli_query($con, $sql6);

                        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                            $idEstado = $fila['idEstado'];
                            $estadoo = $fila['estado'];
                            if ($idEstado == $estado) {
                                echo "<option value='" . $idEstado . "' selected> " . $estadoo . "</option>";
                            } else {
                                echo "<option value='" . $idEstado . "'> " . $estadoo  . "</option>";
                            }
                        }
                        echo "</select>";
                        ?>
                    </select>
                </div>

                <div class="form-floating m-4">
                    <input type="file" placeholder="Seleccione la imagen" accept=".png, .jpg, .jpeg" name="archivoSubir" id="archivoSubir"  class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light " required>
                    <p class="text-end text-light"> Recomendado: 662 x 1000 px </p>
                </div>
                
                <!-- Croppie -->
                    <div class="container"> 
                        <div class="card" id="subirImagen" style='display:none; background: transparent;'>
                            <div class="card-body mx-auto">
                                <div id="imgEditando"></div>
                                <input type="hidden" id="imagenCortada" name="imagenCortada">
                            </div>
                        </div>
                    </div>
                <!-- Croppie -->
            </div>

                <div class="text-center m-4">
                    <button type="submit" class="btn btn-light border rounded" id="btn-agregar" name="btn-agregar">Agregar producto</button>
                    <a type="button" id="regresar" name="regresar" href="./index.php" onclick="return confirm('La información no se guardara ¿Desea regresar?')" class="btn btn-light border border-light rounded"> Volver </a>
                </div>
            </form>
        </div>
    </div>


    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <script src="../../../js/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        $(document).ready(function(){
            var enviarFormulario = false;
            var img = $('#archivoSubir');

            img.on('change', function() {
                var imgName = $(this).val().split('\\').pop();
                var imgExt = imgName.split('.').pop().toLowerCase();
                if ($.inArray(imgExt, ['png', 'jpg', 'jpeg']) == -1) {
                    alert('El tipo de archivo no es válido. Las extensiones permitidas son: png, jpg y jpeg.');
                    $(this).val('');
                }
            });
            
            // Croppie
            img.on('change', function(){
				$('#imgEditando').addClass('ready');
      			$('#imgEditando').croppie('destroy');
				$('#imgEditando').croppie({
					enableExif: true,
					viewport: {
						width: 262,
						height: 400,
					},
					boundary: {
						width: 300,
						height: 450
					}
				});

				var reader = new FileReader();
				reader.onload = function (e) {
					$('#imgEditando').croppie('bind', {
						url: e.target.result
					});
				}
				reader.readAsDataURL(this.files[0]);
                $('#subirImagen').show();
			});

			$('#form').submit(function(e){
				e.preventDefault();

				if(enviarFormulario){
					this.submit();
				}else{
					$('#imgEditando').croppie('result', {
						type: 'canvas',
						size: 'viewport'
					}).then(function(response){
						$('#imagenCortada').val(response);
						enviarFormulario = true;
                        
						$('#form').submit();
					});
				}
			});
        });
        
    </script>

    <?php if (isset($_SESSION["registro_data"])) { unset($_SESSION["registro_data"]); } ?>
</body>

</html>