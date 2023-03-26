<?php
  ob_start();
  session_start();
  if(!isset($_SESSION['Status'])){
      header('Location: ../index.php');
  }

  if (!isset($_REQUEST['id'])) {
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Compra Exitosa </title>
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

    p {
      color: #34a853;
      font-size: 18px;
    }
  </style>
</head>

<body class="bg-secondary">
    <?php include '../modules/menu-footer.php'; ?>
    <?= menu("../"); ?>
  <div class="container text-center mt -5" style="margin-top: 28vh; margin-bottom: auto;">
    <div class="panel panel-default">
      <div class="panel-body">
        <h1 id="Titulo1">Estado de tu Pedido</h1>
        <p class="fw-bold text-dark">La Orden se ha enviado exitósamente. El ID de tu pedido es <?php echo $_GET['id']; ?></p>
        <a class="btn btn-primary rounded-pill mt-3" href="../vistas/usuario/logeado/"> Ver Pedido </a>
      </div>
    </div>
  </div>
</body>

</html>