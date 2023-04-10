<?php
	ob_start();
    session_start();
    if(!isset($_SESSION['Status'])){
        $_SESSION['Foro'] = "<script> alert('Por favor inicie sesión para crear un foro'); </script>";
        header('Location: ../../index.php');
    }

	include "../../../controller/conexion.php";
	$con = new Configuracion;
	$conexion = $con->conectarDB();
	
	if(!empty($_POST['mensaje'])){
		$autor= htmlentities($_POST['autor']);
		$usuario=$_POST['usuario'];
		$titulo= htmlentities($_POST['titulo']);
		$mensaje=$_POST['mensaje'];
		$respuestas=$_POST['respuestas'];
		$identificador=$_POST['identificador'];
		$fecha = date("d-m-y");
		
		$mensaje = htmlentities($mensaje);
		echo "identificador:";
		echo $identificador;
		
		$query = "INSERT INTO foro (nombreLibro, idUsuario, autorLibro, descripcion, idEstado, identificador, fecha, ult_respuesta) 
		VALUES ('$titulo', '$usuario', '$autor', '$mensaje', '1', '$identificador','$fecha','$fecha');";
		
		if(trim(htmlentities($titulo)) == "" OR trim(htmlentities($autor)) == ""  OR trim(htmlentities($mensaje)) == "" ){
			$_SESSION["ErrorDB"] = "No se permiten espacios en blanco.";
			header('Location: formulario.php');
		}else{

			$result = $conexion->query($query);
			
			if ($identificador != 0){
				$query2 = "UPDATE foro SET respuestas=respuestas+1 WHERE id='$identificador'";
				$result2 = $conexion->query($query2);
				echo $query2;
				header("Location: foro.php?id=$identificador");
				exit();
			}

			$_SESSION["ForoAdmin"] = "Su foro ha sido creado.";
			header("Location: formulario.php");
		}
	}
	
?>
<img src="../../codigo/controller/conexion.php" alt="">