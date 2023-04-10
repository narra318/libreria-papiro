<?php
session_start();

class Agregar
{
    function producto()
    {
        include "../controller/conexion.php";
        $conn = new Configuracion();
        $con = $conn->conectarDB();

        $directorio = "img/";  
        $archivo = $directorio.basename($_FILES["archivoSubir"]["name"]);
        $estado = 1;
        
        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        if (isset($_POST["btn-agregar"])) {
            $verificar = getimagesize($_FILES["archivoSubir"]["tmp_name"]);
            if ($verificar == false) {
                $estado = 0;
            }else{
                
            }
        }
    
        // Verificar si el archivo existe
        if (file_exists("$archivo")) {
            $estado=0;
        }
           
    
        // Verificar tipo del archivo
        if ($tipoArchivo != "png" && $tipoArchivo != "jpeg" && $tipoArchivo != "jpg") {
            // echo '<script> alert("Ingrese una imagen de tipo "PNG", "JPEG" o "JPG" ") </script>';
            $estado = 0;
        }else{
        }
    
        // Verificar el tamaño del archivo
        if($_FILES["archivoSubir"]["size"]>1000000){
            $estado = 0;
        }else{
          
        }

        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $imgdir = $directorio.$timestamp.".".$tipoArchivo;
    
        // Verificar si el archivo es apto para subir
        if($estado == 1){
            if(move_uploaded_file($_FILES["archivoSubir"]["tmp_name"], $imgdir)){
                // echo "<br> El archivo ". basename($_FILES["archivoSubir"]["name"]). " ha sido subido exitosamente";
            }else{
                // echo "Ha ocurrido un error";
            }
        }else{
            // $_SESSION["ErrorImg"] = "Lo sentimos, el archivo no ha podido subirse";
        }

        $descripcion = htmlentities($_POST['descripcionProducto']);
    
        $sql = "INSERT INTO libro(nombreLibro, autor, descripcionLibro, precioLibro, cantidad, idEditorial,paginas,publicacion,idPais,idTematica,ISBN,idCategoria,idEstado,img) 
         VALUES('" . htmlentities($_POST['nombreProducto']) . "','" . htmlentities($_POST['autor']) . "','" . $descripcion . "','" . $_POST['precioProducto'] . "','" . $_POST['cantidad'] . "','" . $_POST['editorial'] . "','" . $_POST['n-paginas'] . "',
         '" . $_POST['publicacion'] . "','" . $_POST['pais'] . "','" . $_POST['tematica']  . "','" . $_POST['ISBN']  . "','" . $_POST['categoria'] . "','" . $_POST['estado'] . "',
         '" . '/'.$imgdir."')";

         if(trim(htmlentities($_POST['nombreProducto'])) == "" OR trim(htmlentities($_POST['autor'])) == ""  OR trim(htmlentities($_POST['descripcionProducto'])) == ""  OR trim(htmlentities($_POST['precioProducto'])) == ""  OR trim(htmlentities($_POST['cantidad'])) == ""  OR trim(htmlentities($_POST['n-paginas'])) == ""  OR trim(htmlentities($_POST['publicacion'])) == ""  OR trim(htmlentities($_POST['ISBN'])) == ""){
            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            header('Location: ../../vistas/inventario/agregar-producto.php');

        }else{
            try{
                $con->query($sql);
                $_SESSION["Producto"] = "El producto ha sido ingresado";
                header('Location: ../../vistas/inventario/agregar-producto.php');

            }catch (mysqli_sql_exception $ex) {
                if ($ex->getCode() == 1062) { 
                    $_SESSION["ErrorDB"] = "El libro ya esta registrado";
                    header('Location: ../../vistas/inventario/agregar-producto.php');
                }else {                    
                    $_SESSION["ErrorDB"] = "Error al ingresar el producto en la  base de datos";
                    header('Location: ../../vistas/inventario/agregar-producto.php');
                }
            }
        }
    }
}

$agregado = new Agregar();
$agregado->producto();

?>