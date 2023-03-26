<?php
    include "../../codigo/controller/conexion.php";
    $con = new Configuracion();
    $conexion = $con->conectarDB();

    $busqueda = $_GET["q"];

    $busqueda = mysqli_real_escape_string($conexion, $busqueda);

    // Sentencia SQL
    $sql = "SELECT usuario.idUsuario, usuario.nombreUsuario, usuario.apellidoUsuario, usuario.correoUsuario, 
    roles.rolUsuario, usuario.usuario, estado.estado, pais.nombrePais FROM usuario 
    INNER JOIN pais ON usuario.idPais = pais.idPais 
    INNER JOIN estado ON usuario.idEstado = estado.idEstado 
    INNER JOIN roles ON usuario.idRol = roles.idRol 
    WHERE (usuario.usuario LIKE '%$busqueda%' OR usuario.correoUsuario LIKE '%$busqueda%') LIMIT 21;";

    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado) > 0){
        echo '<div class="container">
        <div class="row justify-content-center overflow-auto">
            <div class="col-md text-center text-white">
                <table class="table bg-dark border border-primary bg-opacity-75 rounded mt-3" id="usuarios">
                    <thead><tr class="text-white"> 
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> ID </th>
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> Rol </th>
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> Estado </th>
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> Usuario </th>
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> Nombre </th>
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> Apellido </th>
                        <th class="border border-info bg-info bg-opacity-50" style="text-align: center;"> Correo </th>
                    </tr></thead>';            
                        

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr class='linea bg-dark text-secondary'>
                        <td class='border border-info'> ".$fila['idUsuario']." </td>
                        <td class='border border-info'> ".$fila['rolUsuario']." </td>
                        <td class='border border-info'> ".$fila['estado']." </td>
                        <td class='border border-info'> ".$fila['usuario']." </td>
                        <td class='border border-info'> ".$fila['nombreUsuario']." </td>
                        <td class='border border-info'> ".$fila['apellidoUsuario']." </td>
                        <td class='border border-info'> ".$fila['correoUsuario']." </td>
                        </tr>";
        }

        echo "</table></div></div></div>";
        echo '<script>
                $(".linea").mouseover(function(){
                    $(this).attr("class", "bg-primary text-white bg-opacity-75");
                });
                $(".linea").mouseout(function() {
                    $(this).attr("class", "bg-dark text-secondary bg-dark p-0");
                });
                $("#usuarios").DataTable({
                    paging: true,
                    ordering: true,
                    info: true,
                });
            </script>';

    }else{
        echo "<div class='container justify-content-center text-light text-center'> No se encontraron resultados </div>";
    }
?>
