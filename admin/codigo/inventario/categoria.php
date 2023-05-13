<?php
session_start();
class categoria
{
    function categorizar()
    {
        include "../controller/conexion.php";
        $conn = new Configuracion();
        $con = $conn->conectarDB();
        $sql = "INSERT INTO categoria (idCategoria, categoria) VALUES (NULL,'" . htmlentities($_POST['nueva-categoria']) . "' )";
        $categoria = $con -> query("SELECT * FROM categoria WHERE categoria='" . htmlentities($_POST['nueva-categoria']) . "';");

        if(mysqli_num_rows($categoria) > 0 ){
            $_SESSION["ErrorDB"]= 'La categoria <b>"'. htmlentities($_POST['nueva-categoria']) . '"</b> ya esta registrada.';
            header("location: ../../vistas/inventario/categoria.php");
        }elseif(trim(htmlentities($_POST['nueva-categoria'])) == ""){
            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            header("location: ../../vistas/inventario/categoria.php");
        }else{
            if ($con->query($sql) === TRUE) {
            $_SESSION["exito"] = 'Se ha creado la categoria <b>"'. htmlentities($_POST['nueva-categoria']) . '"</b> correctamente';
            header('Location: ../../vistas/inventario/agregar-producto.php');
            } else {
                $_SESSION["ErrorDB"]= 'Error al crear la categoria';
                unset($_SESSION['ErrorDB']);
                header('Location: ../../vistas/inventario/categoria.php');
            }
        }
    }
}

$agregado = new categoria();
$agregado->categorizar();
?>