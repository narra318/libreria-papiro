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

    $query = $conexion->query("SELECT status FROM orden WHERE id = '$id'");
    $row = $query->fetch_assoc();
    $estado = $row["status"];
    
    if($estado == 1){
        $sql = "UPDATE orden SET status ='2' WHERE id='$id';";
    }elseif ($estado == 2) {
        $sql = "UPDATE orden SET status ='0' WHERE id='$id';";
    }elseif($estado == 0){
        $sql = "UPDATE orden SET status ='2' WHERE id='$id';";
    }

    
    $actualizar= $conexion->query($sql);
    $_SESSION["actualizadoF"] = "Estado Actualizado.";
    header("location: index.php");
?>