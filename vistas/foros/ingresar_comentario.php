<?php
    ob_start();
    //session_start();

    include_once "../../controller/conexion.php";
        
    $con = new Configuracion();
    $conexion = $con->conectarDB();
    $idForo = $_POST['foro'];
    $idUsuario = $_POST['usuario'];
    $comentario = htmlentities($_POST['comentario']);

    if(trim($nombre) == ""){
        session_start();
        $_SESSION['ErrorDB'] = "No se permiten espacios en blanco.";
        header("Location: foro.php?id=".$idForo);
    }else{   
        // Preparar la consulta preparada
        $queryInsert = "INSERT INTO respuestas ( `idUsuario` , `idForo` , `respuesta` , `fecha`)  VALUES (  ? , ? , ? , CURRENT_TIMESTAMP )";    

        $stmt = $conexion->prepare($queryInsert);
        // Bind de los valores de las variables a los parámetros de la consulta preparada
        $stmt->bind_param('iis', $idUsuario,$idForo,$comentario);
        // Ejecutar la consulta preparada   
        $resultInsert = $stmt->execute();

        if (!$resultInsert) {
            echo "Error al ejecutar la consulta: " . $resultInsert;
            exit();
        } else {
            // Mensaje de confirmación utilizando variable de sesión
            session_start();
            $_SESSION['mensaje'] = "Comentario agregado exitosamente.";
            header("Location: foro.php?id=".$idForo);
        }
    }

    $con->cerrarConexion();
    unset($con);
    unset($conexion);
?>
