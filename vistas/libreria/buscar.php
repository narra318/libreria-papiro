<?php
include '../../controller/conexion.php';

$con = new Configuracion;
$conexion = $con->conectarDB();

$busqueda = $_GET["parametro"]; 

$busqueda = mysqli_real_escape_string($conexion, $busqueda); 


$query = "SELECT s.idForo, f.idUsuario, f.nombreLibro , f.autorLibro, 
u.usuario, s.cantidad
FROM usuario u, foro f, (SELECT  f.id as idForo,  COUNT(r.idForo) as cantidad
FROM respuestas r RIGHT JOIN foro f ON  r.idForo = f.id
WHERE f.idEstado = 1 AND nombreLibro LIKE '%$busqueda%'
GROUP BY f.id 
ORDER BY id DESC) s 
WHERE u.idUsuario = f.idUsuario
AND s.idForo = f.id ";


$result = $conexion->query($query);
if (mysqli_num_rows($result) > 0) {    
    echo '<div class="container">
    <div class="row justify-content-center overflow-auto">
    <div class="col-md text-center text-white">
    <table id="tabla-foros" class="table p-10px" >
    <thead>
                <tr>
                    <th width="20px">  </th>
                    <th width="200px"> Creador </th>
                    <th width="300px">Libro</th>
                    <th width="200px">Autor</th>
                    <th width="100px">Respuestas</th>                    
                </tr>
                </thead>
                <tbody>
    ';   

    while ($row = mysqli_fetch_array($result)) {        
        $id = $row['idForo'];      
        echo "
        <tr>
        <td> <a href='../foros/foro.php?id=$id'>Ver</a></td>                    
                    <td class='border border-info'> ".$row['usuario']." </td>                                   
                    <td class='border border-info'> ".$row['nombreLibro']." </td>
                    <td class='border border-info'> ".$row['autorLibro']." </td>       
                    <td class='border border-info'> ".$row['cantidad']." </td>                                                      
                </tr>";
        
    }
    echo '
    </tbody></table></div></div></div>';

    echo '<script>
    $("#tabla-foros").DataTable({
        paging: true,
        ordering: true,
        info: true,

    });
  </script>';
    
} else {
    echo "<h5 class= 'text-center mx-auto'> No se encontraron resultados</h5>";
}
$conexion = $con->cerrarConexion();
