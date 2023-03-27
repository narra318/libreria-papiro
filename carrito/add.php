<?php
    ob_start();
    session_start();

    include '../controller/conexion.php';
    $conexion = new Configuracion();
    $con = $conexion -> conectarDB();
    $usuarioId = $_SESSION['idUsuario'];
    
    $nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
    $telefono = $con->real_escape_string(htmlentities($_POST['telefono']));
    $ciudad = $con->real_escape_string(htmlentities($_POST['ciudad']));
    $direccion = $con->real_escape_string(htmlentities($_POST['direccion']));
    $masInf = $con->real_escape_string(htmlentities($_POST['masInfo']));

    if($masInf == ''){
        $masInf="----";
    }

    $agregar="INSERT INTO clientes(idUsuario, name, phone, ciudad, address, masInf, created, modified, status)
    VALUES('$usuarioId','$nombre','$telefono','$ciudad','$direccion','$masInf','".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."','1');";

    $agregar= $con->query($agregar);

    if ($agregar === TRUE) {
        $_SESSION["creado"] = "Se ha añadido la información exitosamente.";
        header('Location: infEnvio.php');
    } else {
        $_SESSION["ErrorDB"] = "Error al añadir la información en el sistema.";
        header('Location: infEnvio.php');
    }
?>