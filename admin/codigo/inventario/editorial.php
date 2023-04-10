<?php
session_start();

class editorial
{
    function editar()
    {
        include "../controller/conexion.php";
        $conn = new Configuracion();
        $con = $conn->conectarDB();
        $sql = "INSERT INTO editorial (idEditorial, nombreEditorial) VALUES (NULL,'" . htmlentities($_POST['nueva-editorial']) . "' )";
        $editorial = $con -> query("SELECT * FROM editorial WHERE nombreEditorial = '". htmlentities($_POST['nueva-editorial']) . "';");

        if(mysqli_num_rows($editorial) > 0 ){
            $_SESSION["ErrorDB"]= 'La editorial <strong>"'. htmlentities($_POST['nueva-editorial']) . '"</strong> ya está registrada.';
            header("location: ../../vistas/inventario/editorial.php");
        }elseif(trim(htmlentities($_POST['nueva-categoria'])) == ""){
            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            header("location: ../../vistas/inventario/categoria.php");
        }else{
            if ($con->query($sql) === TRUE) {
                $_SESSION["exito"] = 'Se ha creado la editorial <b>"'. htmlentities($_POST['nueva-editorial']) . '"</b> correctamente';
                header('Location: ../../vistas/inventario/agregar-producto.php');
            } else {
                $_SESSION["ErrorDB"] = "Error al ingresar en la base de datos";
                header('Location: ../../vistas/inventario/editorial.php');
            }
        }
    }
}

$agregado = new editorial();
$agregado->editar();
?>