<?php
session_start();

class Registro{
    function Cusuario(){
        include "../../controller/conexion.php";
        $conexion = new Configuracion();
        $con = $conexion->conectarDB();

        $correo = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];

        // Validar password
        if($_POST['pass'] !== $_POST['pass2']){
            $_SESSION["PassNocoinciden"] = "Las contraseñas no coinciden";
            $_SESSION["registro_data"] = array(
                'correo' => $correo,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario
            );
            header('Location: ../../vistas/usuario/registro.php');
            exit();
        }

        $password = $_POST['pass'];
        if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/', $password)) {
            $_SESSION["PassInvalido"] = "La contraseña debe tener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial, y tener una longitud mínima de 8 caracteres";
            $_SESSION["registro_data"] = array(
                'correo' => $correo,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario
            );
            header('Location: ../../vistas/usuario/registro.php');
            exit();
        }

        include '../../controller/seguridad.php';
        $encriptar = new Seguridad();
        $password = $encriptar->encriptarP($_POST["pass"]);

        // Validar correo
        $correos = "SELECT * FROM usuario WHERE correoUsuario='" . $_POST['correo'] . "';";
        $resultset = $con -> query($correos);

        // Validar usuario
        $usuarios = "SELECT * FROM usuario WHERE usuario='" . $_POST['usuario'] . "';";
        $resultset2 = $con -> query($usuarios);

        if(trim(htmlentities($_POST['nombre'])) == "" OR trim(htmlentities($_POST['apellido'])) == ""  OR trim(htmlentities($_POST['correo'])) == ""  OR trim(htmlentities($_POST['usuario'])) == ""  OR trim(htmlentities($_POST['pass'])) == "" ){
            $_SESSION["ErrorDB"]= 'No se permiten espacios en blanco.';
            $_SESSION["registro_data"] = array(
                'correo' => $correo,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario
            );
            header('location: ../../vistas/usuario/registro.php');
        }elseif($resultset -> num_rows > 0){
            $_SESSION["Correo"] = 'El correo ya existe, por favor inicie sesión o utilice otro.';
            $_SESSION["registro_data"] = array(
                'correo' => $correo,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario
            );
            header('Location: ../../vistas/usuario/registro.php');
        }
        elseif($resultset2 -> num_rows > 0){
            $_SESSION["user"] = 'El usuario ya existe';
            $_SESSION["registro_data"] = array(
                'correo' => $correo,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario
            );
            header('Location: ../../vistas/usuario/registro.php');
        }
        elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $_SESSION["InvalidoCorreo"] = "El correo ingresado no es válido";
                $_SESSION["registro_data"] = array(
                    'correo' => $correo,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'usuario' => $usuario
                );
                header('Location: ../../vistas/usuario/registro.php');
                exit();
        }
         else{
            $nombre = htmlentities($_POST['nombre']);
            $apellido = htmlentities($_POST['apellido']);
            $correo = htmlentities($_POST['correo']);
            $rol = 3;
            $usuario = htmlentities($_POST['usuario']);
            $pais = "241";

            $sql = "INSERT INTO usuario(nombreUsuario, apellidoUsuario, correoUsuario, idRol, usuario, contrasenaUsuario, idEstado, idPais)
            VALUES('" . $nombre . "','" . $apellido . "','" . $correo . "','" . $rol . "','" . $usuario. "','" . $password . "','1','" . $pais . "');";

            if ($con->query($sql) === TRUE) {
                $sql = "SELECT * FROM usuario WHERE (correoUsuario='".$correo."' OR usuario='".$usuario."') AND contrasenaUsuario='".$password."' AND (idRol='3' OR idRol='1') AND idEstado='1';";
                $resultset = $con -> query($sql);

                if($resultset -> num_rows > 0){
                    while ($fila = $resultset -> fetch_assoc()){
                        $_SESSION['Status'] = $fila['nombreUsuario'];
                        $_SESSION['idUsuario'] = $fila['idUsuario'];
                        header('Location: ../../vistas/usuario/logeado/');
                    }
                }
            } else {
                $_SESSION["ErrorDB"] = "Error al crear en usuario, revise los campos";
                header('Location: ../../vistas/usuario/registro.php');
            }
        }
    }
}
$usuario = new Registro();
$usuario->Cusuario();