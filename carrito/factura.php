<?php 
    ob_start(); 
    session_start(); 
    if (!isset($_SESSION['Status'])) {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title> Factura del pedido </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/style.css">
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
            
            <h1 id="Titulo1" style="text-align: center;"> Factura de la compra: #APPR<?php echo $id ?> </h1>

            
            <div class="row">
                <div class="col"><p> Fecha de compra: <?php echo $created ?></p>
                <p> Nombre: <?php echo $nombre ?></p>
                <p> Télefono: <?php echo $tel ?></p>
                <p> Dirección: <?php echo $fila['address'], "  " ,$fila['ciudad'] ?></p></div>
                <div class="col"><p style="color: red; text-align: right">Total: $<?php echo $total ?> COP </p></div>
            </div>

            <?php } ?>
            
            <div class="overflow-auto p-4" style="text-align: center;">
                <table style="border-color: 1px solid black; border-collapse: collapse; width: 100%">
                    <tr> 
                        <th class="border border-primary" style="border: 1px solid black; padding: 10px;" > Producto: </th> 
                        <th class="border border-primary" style="border: 1px solid black; padding: 10px;"> Precio: </th> 
                        <th class="border border-primary" style="border: 1px solid black; padding: 10px;"> Cant: </th> 
                        <th class="border border-primary" style="border: 1px solid black; padding: 10px;"> Subtotal: </th> 
                    </tr>
                    
                <?php while ($row = $resulset->fetch_assoc()) { ?>
                    <tr>
                        <td class="border border-primary"  style="border: 1px solid black; padding: 20px;" > <?php echo $row['nombreLibro']; ?> </td>
                        <td class="border border-primary"  style="border: 1px solid black; padding: 20px;" > $<?php echo number_format($row['precioLibro']); ?> COP </td>
                        <td class="border border-primary"  style="border: 1px solid black; padding: 20px; text-align: center;" > <?php echo $row['quantity']; ?> </td>
                        <td class="border border-primary"  style="border: 1px solid black; padding: 20px;" > $<?php echo number_format($row['precioLibro']*$row['quantity']); ?> COP </td>
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