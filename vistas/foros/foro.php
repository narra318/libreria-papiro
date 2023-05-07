<?php
ob_start();
session_start();

include "../../controller/conexion.php";


if (!isset($_SESSION['Status'])) {
	header('Location: ../libreria/foros.php');
	exit();
}

$con = new Configuracion;
$conexion = $con->conectarDB();

if (isset($_GET['id'])) {
	$idForo = $_GET['id'];
	$idUsuario = $_SESSION['idUsuario'];

	$query = "SELECT * FROM foro 
              INNER JOIN usuario ON foro.idUsuario = usuario.idUsuario
              WHERE id = ? ORDER BY foro.fecha DESC";

	$stmt = $conexion->prepare($query);
	$stmt->bind_param("i", $idForo);
	$stmt->execute();

	$result = $stmt->get_result();


	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$id = $row['id'];
		$nombreUsuario = $row['nombreUsuario'];
		$titulo = $row['nombreLibro'];
		$autor = $row['autorLibro'];
		$mensaje = $row['descripcion'];
		$fecha = $row['fecha'];
	}
	$con->cerrarConexion();
	unset($conexion);
	unset($con);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title><?php echo $titulo ?></title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../img/icono2.png" type="image/ico" />
	<link rel="apple-touch-icon" href="../../img/icono2.png">
	<link rel="stylesheet" href="../../css/custom.css">
	<script src="../../js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../../js/jquery-3.6.1.min.js"></script>
	<link href="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<style>
		.comentario:nth-child(n+5) {
			display: none;
		}
	</style>
</head>

<body class="bg-secondary">
	<?php include '../../modules/menu-footer.php'; ?>
	<?= menu("../.."); ?>
	<?php if (isset($_SESSION['mensaje'])) {
		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . $_SESSION['mensaje'];
		echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		unset($_SESSION['mensaje']);
	}

	if (isset($_SESSION['Error'])) {
		echo "<div class='alert alert-secondary rounded text-center alert-dismissible fade show' role='alert'> <b><i class='bi bi-exclamation-circle'></i></b> &nbsp;" . $_SESSION['Error'];
		echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		unset($_SESSION['Error']);
	}

	?>
	<div class="container">
		<p class="text-end mt-5" id="" style="color: black;">Creado por <?php echo $nombreUsuario ?></p>
		<h1 class="text-center mt-5" id="Titulo2"><?php echo $titulo ?></h1>
		<h3 class="text-center"><b>Autor:</b> <?php echo $autor ?></h3>
		<p class="p-5 text-dark" id="parrafo-msj"> <?php echo $mensaje ?></p>

		<div id="comentarios" class="mt-5">

			<?php

			?>

		</div>

		<form action="ingresar_comentario.php" method="POST" id="nuevo-comentario">
			<div class="text-end pe-5">
				<button type="submit" id="enviar-comentario" class="btn btn-outline-primary border border-primary rounded" >Enviar</button>
				<a href="../libreria/foros.php" class="btn btn-outline-primary border border-primary rounded">Volver</a>
			</div>
			<textarea class="form-control mt-3 rounded" rows="3" name="comentario" id="comentario" placeholder="Escribe tu comentario"></textarea>
			<input type="hidden" name="foro" id="foro" value="<?php echo $idForo ?>">
			<input type="hidden" name="usuario" id="usuario" value="<?php echo $idUsuario ?>">
		</form>

		<div>
			<p class="mt-5 text-dark fw-bold " style="width: 6rem;"> Comentarios:</p>
			<hr>

			<div id="respuestas">

				<?php include "ver-respuestas.php";	?>

			</div>
		</div>
	</div>

	<div class="mb-3"> &nbsp; </div>

	<div><?= footer(); ?></div>

	<script src="../../js/jquery-3.6.1.min.js"></script>

</body>
</html>