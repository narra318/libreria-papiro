<?php
session_start();

class Agregar
{
    function producto()
    {
        include "../controller/conexion.php";
        $conn = new Configuracion();
        $con = $conn->conectarDB();

        $nombre = $_POST['nombreProducto'];
        $autor = $_POST['autor'];
        $desc = $_POST['descripcionProducto'];
        $precio = $_POST['precioProducto'];
        $ISBN = $_POST['ISBN'];
        $paginas = $_POST['n-paginas'];
        $cantidad = $_POST['cantidad'];
        $publicacion = $_POST['publicacion'];
        $editorial = $_POST['editorial'];
        $categoria = $_POST['categoria'];
        $tematica = $_POST['tematica'];
        $pais = $_POST['pais'];
        $status = $_POST['estado'];

        if(isset($_POST["imagenCortada"]))
        {
            $directorio = "img/";  
            $estado = 1;

            $date = new DateTime();
            $timestamp = $date->getTimestamp();

            $data = $_POST["imagenCortada"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = $timestamp. '.jpg';

            $imgdir = $directorio.$imageName;
    
            // Verificar si el archivo es apto para subir
            if($estado == 1){
                file_put_contents('img/'.$imageName, $data);
            }
        }

        if(trim($imgdir) == ""){
            $imgdir = "img/PortadaPredeterminada.jpg";
        }

        $descripcion = htmlentities($_POST['descripcionProducto']);
    
        $sql = "INSERT INTO libro(nombreLibro, autor, descripcionLibro, precioLibro, cantidad, idEditorial,paginas,publicacion,idPais,idTematica,ISBN,idCategoria,idEstado,img) 
         VALUES('" . htmlentities($_POST['nombreProducto']) . "','" . htmlentities($_POST['autor']) . "','" . $descripcion . "','" . $_POST['precioProducto'] . "','" . $_POST['cantidad'] . "','" . $_POST['editorial'] . "','" . $_POST['n-paginas'] . "',
         '" . $_POST['publicacion'] . "','" . $_POST['pais'] . "','" . $_POST['tematica']  . "','" . $_POST['ISBN']  . "','" . $_POST['categoria'] . "','" . $_POST['estado'] . "',
         '" . '/'.$imgdir."')";

         if(trim(htmlentities($_POST['nombreProducto'])) == "" OR trim(htmlentities($imgdir)) == "" OR trim(htmlentities($_POST['autor'])) == ""  OR trim(htmlentities($_POST['descripcionProducto'])) == ""  OR trim(htmlentities($_POST['precioProducto'])) == ""  OR trim(htmlentities($_POST['cantidad'])) == ""  OR trim(htmlentities($_POST['n-paginas'])) == ""  OR trim(htmlentities($_POST['publicacion'])) == ""  OR trim(htmlentities($_POST['ISBN'])) == ""){
            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            $_SESSION["registro_data"] = array(
                'nombre' => $nombre,
                'autor' => $autor,
                'descripcion' => $desc,
                'precio' => $precio,
                'ISBN' => $ISBN,
                'paginas' => $paginas,
                'cantidad' => $cantidad,
                'publicacion' => $publicacion,
                'editorial' => $editorial,
                'categoria' => $categoria,
                'tematica' => $tematica,
                'pais' => $pais,
                'estado' => $status
            );
            header('Location: ../../vistas/inventario/agregar-producto.php');

        }else{
            try{
                $con->query($sql);
                $_SESSION["Producto"] = "El libro ha sido ingresado correctamente";
                header('Location: ../../vistas/inventario/agregar-producto.php');

            }catch (mysqli_sql_exception $ex) {
                if ($ex->getCode() == 1062) { 
                    $_SESSION["ErrorDB"] = "El libro ya esta registrado";
                    $_SESSION["registro_data"] = array(
                        'nombre' => $nombre,
                        'autor' => $autor,
                        'descripcion' => $desc,
                        'precio' => $precio,
                        'ISBN' => $ISBN,
                        'paginas' => $paginas,
                        'cantidad' => $cantidad,
                        'publicacion' => $publicacion,
                        'editorial' => $editorial,
                        'categoria' => $categoria,
                        'tematica' => $tematica,
                        'pais' => $pais,
                        'estado' => $status
                    );
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