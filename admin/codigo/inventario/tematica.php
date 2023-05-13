<?php
session_start();
class tematica
{
    function tematizar()
    {
        include "../controller/conexion.php";
        $conn = new Configuracion();
        $con = $conn->conectarDB();
        $sql = "INSERT INTO tematica (idTematica, tematica) VALUES (NULL,'" . $_POST['nueva-tematica'] . "' )";
        $tematica = $con -> query("SELECT * FROM tematica WHERE tematica = '". htmlentities($_POST['nueva-tematica']) . "';");

        if(mysqli_num_rows($tematica) > 0 ){
            $_SESSION["ErrorDB"]= 'La tematica <strong>"'. htmlentities($_POST['nueva-tematica']) . '"</strong> ya está registrada.';
            header("location: ../../vistas/inventario/tematica.php");
        }elseif(trim(htmlentities($_POST['nueva-categoria'])) == ""){
            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            header("location: ../../vistas/inventario/categoria.php");
        }else{
            if ($con->query($sql) === TRUE) {
                $_SESSION["exito"] = 'Se ha creado la tematica <b>"'. htmlentities($_POST['nueva-tematica']) . '"</b> correctamente.';
                header('Location: ../../vistas/inventario/agregar-producto.php');
            } else {
                $_SESSION["ErrorDB"] = "Error al ingresar en la base de datos";
                header('Location: ../../vistas/inventario/tematica.php');
            }
        }
    }
}

$agregado = new tematica();
$agregado->tematizar();
?>