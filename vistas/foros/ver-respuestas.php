<?php

include_once "../../controller/conexion.php";

$con = new Configuracion;
$conexion = $con->conectarDB();

$queryComentarios = "SELECT usuario.usuario,respuestas.fecha,respuestas.respuesta FROM respuestas 
		INNER JOIN usuario ON respuestas.idUsuario = usuario.idUsuario 
		INNER JOIN foro ON respuestas.idForo = foro.id
		WHERE id = ? ORDER BY respuestas.fecha ASC ";
$stmt = $conexion->prepare($queryComentarios);

// Bind del valor de la variable al parámetro de la consulta preparada
$stmt->bind_Param('i', $idForo);

// Ejecutar la consulta preparada
$stmt->execute();
$resultComentarios = $stmt->get_result();

if (mysqli_num_rows($resultComentarios) > 0) {
	while ($row = mysqli_fetch_array($resultComentarios, MYSQLI_ASSOC)) {
		echo "<div class='card mb-5'>";
		echo "<div class='card-body'>";
		echo "<div class='d-flex justify-content-between align-items-center'>";
		echo "<h5 class = 'title'>".$row['usuario']."</h5>";
		echo "<h6 class='card-subtitle mb-2 text-muted'>" . $row['fecha'] . "</h6>";
		echo "</div>";
		echo "<p class='card-text'>" . $row['respuesta'] ."</p>";
		echo "</div>";
		echo "</div>";
	}
	$con->cerrarConexion();
} else {
	echo "<h5 class='mb-5'> No hay comentarios aún.</h5>";
}

if (!$resultComentarios) {
	echo "Error al ejecutar la consulta: " . $resultInsert;
	exit();
}
