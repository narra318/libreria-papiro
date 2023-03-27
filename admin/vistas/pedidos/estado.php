<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['Admin'])){
        header('Location: ../../index.php');
    }

    include "../../codigo/controller/conexion.php";
    $con = new Configuracion;
    $conexion = $con->conectarDB();

    $id = $_GET['id'];
    $sql = "UPDATE orden SET status ='0' WHERE id='$id';";
    $actualizar= $conexion->query($sql);
    $_SESSION["actualizadoF"] = "Estado Actualizado.";
    header("location: index.php");
?>