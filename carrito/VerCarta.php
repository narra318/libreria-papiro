<?php
    ob_start();
    include 'La-carta.php';
    if (!isset($_SESSION['Status'])) {
        $_SESSION['carritoIngreso'] = "<script> alert('Por favor inicie sesión para añadir productos al carrito'); </script>";
        header('Location: ../vistas/usuario/');
    }
    include "configuracion.php";
    $cart = new Cart;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Carrito </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Página de catálago de la libreria papiro">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icono2.png" type="image/ico" />
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
        }

        input[type="number"] {
            width: 20%;
        }
        .menu-side:hover{
            color: #ffffff;
            text-shadow: 0px 0px 20px #B9B4BF;
        }

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
            background-color: #88456a;
            color: #ffffff;
            text-shadow: 0px 0px 10px #ffffff;
        }
    </style>
</head>

<body class="bg-secondary">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>

    <div class="row me-0">
        <div class="col-md-3"> <?=  menuSide("", "active","","","../"); ?> </div>
        <div class="col-md-9 ms-0 contenido" style="height: 100vh; overflow: auto;">
    <div class="container mt-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center mb-5" id="Titulo1">Carrito de compras <i class="bi bi-cart"></i> </h1>
                <table class="table text-dark">
                    <thead class="text-center">
                        <tr class="text-dark">
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Sub total</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                            
                        if ($cart->total_items() > 0) {
                            $cartItems = $cart->contents();

                            foreach ($cartItems as $item) :
                                $nombreLibro = $item["name"];
                                $query = $db->query("SELECT cantidad FROM libro WHERE nombreLibro = '$nombreLibro'");
                                $row = $query->fetch_assoc();
                                $cant = $row["cantidad"];
                        ?>
                        
                                <tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo '$' . number_format($item["price"]) . ' COP'; ?></td>
                                    <td> <input type="number" min="1" max="<?php echo $cant ?>" class="m-4 mb-1 mt-2 text-center bg-secondary" style="width:max-content; border: solid 1px #88456a;" value="<?php echo $item["qty"] ?>" onchange="updateCartItem(this, '<?php echo $item['rowid']; ?>')"></td>
                                    <td><?php echo '$' . number_format($item["subtotal"]) . ' COP'; ?></td>
                                    <td>
                                        <a href="AccionCarta.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger rounded-pill" onclick="return confirm('¿Confirma eliminar?')"> <i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } else { ?>
                            <tr>
                                <td colspan="5">
                                    <p>No has solicitado ningún producto...</p>
                                </td>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><br><a href="../vistas/libreria/catalogo.php" class="btn btn-primary rounded"><i class="glyphicon glyphicon-menu-left"></i> Volver al catalogo</a></td>
                            <td colspan="2"></td>
                            <?php if ($cart->total_items() > 0) { ?>
                                <td class="text-center text-dark"><br><strong>Total: <?php echo '$' . number_format($cart->total()) . ' COP'; ?></strong></td>
                                <td class="m-3"><br><a href="Pagos.php" class="btn btn-primary rounded-pill btn-block"> Pagar <i class="glyphicon glyphicon-menu-right"></i></a><br> </td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div></div><?= footer(); ?>
    </div>
    
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function updateCartItem(obj, id) {
            $.get("AccionCarta.php", {
                action: "updateCartItem",
                id: id,
                qty: obj.value
            }, function(data) {
                if (data == 'ok') {
                    location.reload();
                } else {
                    alert('No se pudo actualizar el carrito,por favor intente de nuevo.');
                }
            });
        }
    </script>
</body>
</html>