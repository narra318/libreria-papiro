<?php
date_default_timezone_set("America/Lima");
// Iniciamos la clase de la carta
include 'La-carta.php';
$cart = new Cart;
include 'Configuracion.php';

if (!isset($_SESSION['Status'])) {
    $_SESSION['carritoIngreso'] = "<script> alert('Por favor inicie sesión para añadir productos al carrito'); </script>";
    header('Location: ../vistas/usuario/index.php');
}else{

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // get product details
        $query = $db->query("SELECT * FROM libro WHERE idLibro = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['idLibro'],
            'name' => $row['nombreLibro'],
            'price' => $row['precioLibro'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'VerCarta.php':'index.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: VerCarta.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['idUsuario'])){
        $JustIdUser = $_SESSION['idUsuario'];
        $query = $db->query("SELECT id FROM clientes WHERE idUsuario = ".$JustIdUser);
        $row = $query->fetch_assoc();
        $idUser = $row["id"];

        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orden (customer_id, total_price, created, modified) VALUES ('".$idUser."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO orden_articulos (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
                
                $cantQuery = $db->query("SELECT cantidad FROM libro WHERE idLibro=".$item['id'].";");
                $cantRow = $cantQuery->fetch_assoc();
                $cant = $cantRow['cantidad'];
                $cantidad =  $cant - (int)$item['qty'];
            
                $act = "UPDATE libro SET cantidad = $cantidad WHERE idLibro=".$item['id'].";";
                $final = $db -> query($act);
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: OrdenExito.php?id=$orderID");
            }else{
                header("Location: Pagos.php");
            }
        }else{
            header("Location: Pagos.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
}
?>