<?php
    ob_start();
    session_start();

    include_once "../../controller/conexion.php";
        
    $con = new Configuracion();
    $conexion = $con->conectarDB();
    $idForo = $_POST['foro'];
    $idUsuario = $_POST['usuario'];
    $comentario = htmlspecialchars($_POST['comentario']);
    $malas_palabras = array("perra", "hijueputa", "malparida", "malparido", "malparidas", "malparidos", "idiota", "estupido", "imbecil", "puta", "jodido", "cabron", "maricon", "imbecil","hdpt", "mierda", "cono", "verga", "concha", "puto"); // Lista de malas palabras

    foreach ($malas_palabras as $palabra) {
        if (strpos(strtolower($comentario), $palabra) !== false) {
            $_SESSION['Error'] = "No se permiten malas palabras.";
            header("Location: foro.php?id=".$idForo);
            exit();
        }
    }
    
    if(trim($comentario) == ""){
        session_start();
        $_SESSION['Error'] = "No se permiten espacios en blanco.";
        header("Location: foro.php?id=".$idForo);
        exit();
    }else{   
        $queryInsert = "INSERT INTO respuestas ( `idUsuario` , `idForo` , `respuesta` , `fecha`)  VALUES (  ? , ? , ? , CURRENT_TIMESTAMP )";    

        $stmt = $conexion->prepare($queryInsert);
        $stmt->bind_param('iis', $idUsuario,$idForo,$comentario);
        $resultInsert = $stmt->execute();

        if (!$resultInsert) {
            echo "Error al ejecutar la consulta: " . $resultInsert;
            exit();
        } else {
            session_start();
            $_SESSION['mensaje'] = "Comentario agregado exitosamente.";
            header("Location: foro.php?id=".$idForo);
            exit();
        }
    }

    $con->cerrarConexion();
    unset($con);
    unset($conexion);
?>
