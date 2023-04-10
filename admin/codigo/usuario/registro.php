<?php
session_start();

class Registro{
    function Cusuario(){
        include '../controller/conexion.php';
        $conn = new Configuracion();
        $con = $conn->conectarDB();

        include "../controller/seguridad.php";
        $encriptar = new Seguridad();
        $contrasena = $encriptar->encriptarP($_POST['pass']);

        $email = $_POST['correo'];

        // Validar correo
        $correo = "SELECT * FROM usuario WHERE correoUsuario='" . $_POST['correo'] . "';";
        $resultset = $con -> query($correo);

        // Validar usuario
        $usuario = "SELECT * FROM usuario WHERE usuario='" . $_POST['usuario'] . "';";
        $resultset2 = $con -> query($usuario);
        // $url = $_SERVER[''];

        if(trim(htmlentities($_POST['nombre'])) == "" OR trim(htmlentities($_POST['apellido'])) == ""  OR trim(htmlentities($_POST['correo'])) == ""  OR trim(htmlentities($_POST['usuario'])) == ""  OR trim(htmlentities($_POST['pass'])) == "" ){

            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            header('location: ../../vistas/usuario/registro.php');
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["Correo"] = 'El correo electrónico no es válido.';
            header('Location: ../../vistas/usuario/registro.php');
        }elseif($resultset -> num_rows > 0){
            $_SESSION["Correo"] = 'El correo ya esta registrado.';
            header('Location: ../../vistas/usuario/registro.php');
        }
        elseif($resultset2 -> num_rows > 0){
            $_SESSION["user"] = 'El usuario ya existe';
            header('Location: ../../vistas/usuario/registro.php');
        } 
        else{
            $sql = "INSERT INTO usuario(nombreUsuario, apellidoUsuario, correoUsuario, idRol, usuario, contrasenaUsuario, idEstado, idPais) 
            VALUES('" . htmlentities($_POST['nombre']) . "','" . htmlentities($_POST['apellido']) . "','" . htmlentities($_POST['correo']) . "','3','" . htmlentities($_POST['usuario']) . "','" . $contrasena . "','1','241');";

            if ($con->query($sql) === TRUE) {
                $_SESSION["creado"] = "Se ha creado el usuario exitosamente";
                header('Location: ../../vistas/usuario/registro.php');
            } else {
                $_SESSION["ErrorDB"] = "Error al crear en usuario en la base de datos ";
                header('Location: ../../vistas/usuario/registro.php');
            }
        }
    }
}
$usuario = new Registro();
$usuario->Cusuario();

?>