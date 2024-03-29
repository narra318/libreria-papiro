<?php
    ob_start();
    session_start();
    if (!isset($_SESSION['Admin'])) {
        header('Location: ../../');
    }

    include "../../codigo/controller/conexion.php";
    $con = new Configuracion;
    $conexion = $con->conectarDB();

    $id = $_GET['id'];
    $sql = "SELECT usuario.idUsuario, usuario.nombreUsuario, usuario.apellidoUsuario, usuario.correoUsuario, 
            roles.rolUsuario, usuario.idRol, usuario.usuario, usuario.idEstado, estado.estado FROM usuario 
            INNER JOIN estado ON usuario.idEstado = estado.idEstado 
            INNER JOIN roles ON usuario.idRol = roles.idRol 
        WHERE idUsuario='$id' LIMIT 21;";
        
    $modificar = $conexion->query($sql);
    $dato = $modificar->fetch_array();

    if (isset($_POST['modificar'])) {
        $idU = $_POST['idUsuario'];

        $idUsuario = $conexion->real_escape_string($_POST['idUsuario']);
        $Rol = $conexion->real_escape_string($_POST['rolUsuario']);
        $Estado = $conexion->real_escape_string($_POST['estado']);
        $usuario = $conexion->real_escape_string($_POST['usuario']);
        $nombre = $conexion->real_escape_string($_POST['nombreUsuario']);
        $apellido = $conexion->real_escape_string($_POST['apellidoUsuario']);
        $correo = $conexion->real_escape_string($_POST['correoUsuario']);

        $actualiza = "UPDATE usuario SET nombreUsuario='".htmlentities($nombre)."', apellidoUsuario='".htmlentities($apellido)."', correoUsuario='".htmlentities($correo)."', idRol='$Rol', usuario='".htmlentities($usuario)."', idEstado='$Estado' WHERE idUsuario='$idU'";

        if(trim(htmlentities($_POST['idUsuario'])) == "" OR trim(htmlentities($_POST['rolUsuario'])) == ""  OR trim(htmlentities($_POST['estado'])) == ""  OR trim(htmlentities($_POST['usuario'])) == ""  OR trim(htmlentities($_POST['nombreUsuario'])) == "" OR trim(htmlentities($_POST['apellidoUsuario'])) == "" OR trim(htmlentities($_POST['correoUsuario'])) == "" ){
            $_SESSION["actualizadoE"]= 'No se permiten espacios en blanco.';
        }else{
            try{

                $actualizar = $conexion->query($actualiza);
                $_SESSION["actualizado"] = "Se ha actualizado el usuario correctamente";
                header("location: ../../vistas/usuario/modificar-listar.php");

            }catch (mysqli_sql_exception $ex) {
                if ($ex->getCode() == 1062) { 
                    $_SESSION["actualizadoE"] = "El usuario o correo electronico ya esta registrado";
                }else {
                    echo "Se ha producido un error al ejecutar la operación: " . $ex->getMessage();
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Modificar usuario - <?php echo $dato['nombreUsuario']; ?> </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Permite al administrador modificar los usuarios existente.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../../../css/custom.css">
    <script src="../../../js/bootstrap.bundle.min.js"> </script>
    <link href="../../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../../../img/fondos/fondo-admin.jpg');
            background-size: 100%;
        }

        #Link a {
            text-decoration: none;
            color: #B9B4BF;
        }

        #Link a:hover {
            text-decoration: none;
            color: white;
            font-size: 17px;
        }
    </style>
</head>

<body class="bg-dark ">
    <?php include '../../../modules/menu-footer.php'; ?>
    <?= menuAdmin("../../../"); ?>
    <?php
        
        if(isset($_SESSION["actualizadoE"])){
            echo '<div class="alert alert-warning m-0 alert-dismissible fade show text-center">
                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                <strong> <i class="bi bi-exclamation-circle"></i> Error:</strong> ';
            echo $_SESSION["actualizadoE"];
            echo '</div>';
            unset($_SESSION['actualizadoE']);
        }
    ?>

    <p id="Titulo3" class="text-center text-light mt-5"> Modificar Usuario <?php $usuario ?> <i class="bi bi ms-2"></i> </p>

    <div class="container-fluid justify-content-center">
        <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id ?>" method="POST">
            <div class="row justify-content-center">
                <div class="col-md-6 p-5 justify-content-center">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $dato['idUsuario']; ?>">

                    <div class="form-floating m-4">
                        <input type="text" value="<?php echo $dato['nombreUsuario']; ?>" placeholder="Ingrese su nombre" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" name="nombreUsuario" id="nombreUsuario" required>
                        <label for="nombre" class="text-light">Nombre</label>
                    </div>
                    <div class="form-floating m-4">
                        <input type="text" value="<?php echo $dato['apellidoUsuario']; ?>" placeholder="Ingrese su apellido" name="apellidoUsuario" id="apellidoUsuario" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+(?:[ \t][a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+)*$"   class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="apellido" class="text-light">Apellido</label>
                    </div>

                    <div class="form-floating m-4">
                        <input type="email" value="<?php echo $dato['correoUsuario']; ?>" placeholder="Ingrese su correo" name="correoUsuario" id="correoUsuario" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="correo" class="text-light">Correo</label>
                    </div>
                </div>

                <div class="col-md-6 p-5 justify-content-center">
                    <div class="form-floating m-4">
                        <input type="text"  pattern="[A-Za-z0-9]+"  placeholder="Ingrese su usuario" value="<?php echo $dato['usuario']; ?>" name="usuario" id="usuario" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                        <label for="usuario" class="text-light">Usuario</label>
                    </div>

                    <div class="form-floating m-4">
                        <select name="estado" id="estado" class="form-control bg-dark bg-opacity-75 text-light border-bottom border-light" required>
                            <option selected="true" value="<?php echo $dato['idEstado']; ?>" > <?php echo $dato['estado']; ?> </option>
                            <?php
                            $sql2 = "SELECT * from estado";
                            $resultado_consulta_mysql = mysqli_query($conexion, $sql2);

                            while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                                $idEstado = $fila['idEstado'];
                                $estado = $fila['estado'];
                                echo "<option value='" . $idEstado . "'> " . $estado  . "</option>";
                            }
                            echo "</select>";
                            ?>
                            <label for="pais">Estado</label>
                    </div>

                    
                    <div class="form-floating m-4">
                        <select name="rolUsuario" id="rolUsuario" class="form-control bg-dark bg-opacity-50 text-light border-bottom border-light" required>
                            <option value="<?php echo $dato['idRol']; ?>" selected="true"> <?php echo $dato['rolUsuario']; ?> </option>
                            <?php
                            $sql1 = "SELECT * FROM roles WHERE idRol='3';";
                            $resultado_consulta_mysql = mysqli_query($conexion, $sql1);

                            while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
                                $idRol = $fila['idRol'];
                                $rol = $fila['rolUsuario'];
                                echo "<option value='" . $idRol . "'> " . $rol  . "</option>";
                            }
                            echo "</select>";
                            ?>
                            <label for="">Rol</label>
                    </div>
                </div>

                <div class="text-end m-4 mt-0 text-center">
                    <button type="submit" name="modificar" id="modificar" class="btn btn-light border"> Modificar </button>
                    <a type="button" href="../../vistas/usuario/modificar-listar.php" name="regresar" id="regresar" class="btn btn-light border" onclick="return confirm('Los cambios no se guardarán ¿Desea regresar?')">Regresar</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>