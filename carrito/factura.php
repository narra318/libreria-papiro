<?php 
    ob_start(); 
    session_start(); 
    if (!isset($_SESSION['Status'])) {
        header('Location: ../index.php');
    }

    $nombreImagen = "../img/icono2.png";
    $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title> Factura del pedido </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $imagenBase64 ?>" type="image/ico" />
    <link href="../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="margin: 50px; margin-top: 20px;">

    <div class="row me-0 justify-content-center mx-auto p-5">
            <?php
                include "../controller/conexion.php";
                $conn = new Configuracion();
                $con = $conn->conectarDB();
                $id = $_GET['id'];
                $usuarioId = $_SESSION['idUsuario'];
                $sql = "SELECT * FROM orden_articulos 
                INNER JOIN orden ON orden_articulos.order_id = orden.id
                INNER JOIN clientes ON orden.customer_id = clientes.id
                INNER JOIN libro ON orden_articulos.product_id = libro.idLibro
                INNER JOIN usuario ON clientes.idUsuario = usuario.idUsuario 
                WHERE clientes.idUsuario = '$usuarioId' AND order_id = $id";
                $resulset = $con->query($sql);
                $sql2 = "SELECT orden.id, orden.customer_id, clientes.name, clientes.phone, clientes.address, clientes.ciudad, orden.total_price, orden.created, orden.status 
                FROM orden INNER JOIN clientes ON orden.customer_id = clientes.id
                WHERE orden.customer_id = clientes.id AND orden.id = $id;";
                $orden = mysqli_query($con, $sql2);
            ?>

            <?php while($fila = mysqli_fetch_array($orden)){
                    $created = $fila['created'];
                    $nombre = $fila['name'];
                    $tel = $fila['phone'];
                    $id = $fila['id'];
                    $total = number_format($fila['total_price']);
            ?>


            <div style="margin-top: 50px;"> <img src="<?php echo $imagenBase64 ?>" style="width: 150px; margin-top: -40px;" alt="Logo de libreria"> </div>


            <div style="text-align: center; margin-top: -280px; margin-left: 80;">
                <h1 id="Titulo1" style="text-align: center;"> Factura de compra </h1>
                <p style="font-size: 16px; margin-top: 10px;">Número de factura: #APPR<?php echo $id ?></p>
            </div>
            
            <div class="row" style="margin-top: 50px;">
                <p style="font-size: 16px; margin-top: 10px;"> Fecha de compra: <?php echo date("d/m/Y", strtotime($created)) ?></p>
                <!-- <div class="col"><p></p> -->
                <p> Nombre: <?php echo $nombre ?></p>
                <p> Télefono: <?php echo $tel ?></p>
                <p> Dirección: <?php echo $fila['address'], "  " ,$fila['ciudad'] ?></p></div>
                <div class="col"><h2 style="color: #53213d; text-align: right">Total: $<?php echo $total ?> COP </h2></div>
            </div>

            <?php } ?>
            
            <div class="overflow-auto p-4" style="text-align: center;">
                <table style="border-color: 1px solid black; border-collapse: collapse; width: 100%">
                    <tr> 
                        <th class="border border-primary" style="border: 1px solid #53213d; padding: 10px; background-color: #a07d94a8;" > Producto: </th> 
                        <th class="border border-primary" style="border: 1px solid #53213d; padding: 10px; background-color: #a07d94a8;"> Precio: </th> 
                        <th class="border border-primary" style="border: 1px solid #53213d; padding: 10px; background-color: #a07d94a8;"> Cant: </th> 
                        <th class="border border-primary" style="border: 1px solid #53213d; padding: 10px; background-color: #a07d94a8;"> Subtotal: </th> 
                    </tr>
                    
                <?php while ($row = $resulset->fetch_assoc()) { ?>
                    <tr>
                        <td class="border border-primary"  style="border: 1px solid #53213d; background-color: #b9b4bf76; padding: 20px;" > <?php echo $row['nombreLibro']; ?> </td>
                        <td class="border border-primary"  style="border: 1px solid #53213d; background-color: #b9b4bf76; padding: 20px;" > $<?php echo number_format($row['precioLibro']); ?> COP </td>
                        <td class="border border-primary"  style="border: 1px solid #53213d; background-color: #b9b4bf76; padding: 20px; text-align: center;" > <?php echo $row['quantity']; ?> </td>
                        <td class="border border-primary"  style="border: 1px solid #53213d; background-color: #b9b4bf76; padding: 20px;" > $<?php echo number_format($row['precioLibro']*$row['quantity']); ?> COP </td>
                    </tr>
                <?php } ?>
                </table>
            </div>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
</body>
</html>

<?php
    $html = ob_get_clean();
    // echo $html;
    require_once '../libs/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options();
    $options->setDefaultFont('Helvetica');
    
    
    $dompdf = new Dompdf($options);
    $dompdf ->loadHtml($html);

    $dompdf ->setPaper('letter');
    
    $dompdf->render();
    $dompdf->stream("factura.pdf", array("Attachment" => false));
?>