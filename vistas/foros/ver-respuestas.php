<?php
	include_once "../../controller/conexion.php";

	$con = new Configuracion;
	$conexion = $con->conectarDB();

	$queryComentarios = "SELECT usuario.usuario,respuestas.fecha,respuestas.respuesta FROM respuestas 
			INNER JOIN usuario ON respuestas.idUsuario = usuario.idUsuario 
			INNER JOIN foro ON respuestas.idForo = foro.id
			WHERE id = ? ORDER BY respuestas.fecha ASC ";
	$stmt = $conexion->prepare($queryComentarios);

	$stmt->bind_Param('i', $idForo);

	$stmt->execute();
	$resultComentarios = $stmt->get_result();

	if (mysqli_num_rows($resultComentarios) > 0) {
		while ($row = mysqli_fetch_array($resultComentarios, MYSQLI_ASSOC)) {

	?>
			<div class='card mb-4 rounded comentario'>
				<div class='card-body'>
					<div class='d-flex justify-content-between align-items-center'>
						<h5 class = 'title'> <?php echo $row['usuario'] ?></h5>
						<h6 class='card-subtitle mb-2 text-muted'> <?php echo $row['fecha'] ?></h6>
					</div>
					<p class='card-text'><?php echo $row['respuesta'] ?></p>
				</div>
			</div>

	<?php	} 
	
		if(mysqli_num_rows($resultComentarios) > 4){
			echo '<div class="text-end"><button id="ver-mas" class="btn btn-primary rounded mb-5">Ver más comentarios</button></div>';
	?>
		<script>
			$("#ver-mas").click(function() {
				$(".comentario:hidden").show();
				$("#ver-mas").hide();
			});
		</script>
		
	<?php
	
		}

		$con->cerrarConexion();
	} else {
		echo "<h5 class='mb-5'> No hay comentarios aún.</h5>";
	}

	if (!$resultComentarios) {
		echo "Error al ejecutar la consulta: " . $resultInsert;
		exit();
	}
?>
