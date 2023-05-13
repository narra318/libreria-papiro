<?php
  ob_start();
  session_start();
  if (!isset($_SESSION['Status'])) {
    $_SESSION['carritoIngreso'] = "<script> alert('Por favor inicie sesión para añadir productos al carrito'); </script>";
    header('Location: ../vistas/usuario/');
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title> Carrito Vacío </title>
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
        <h1 id="Titulo1">No has añadido productos al carrito</h1>
        <p class="fw-bold text-dark"> Regresa al catalogo y añade un producto </p>
        <a class="btn btn-primary rounded-pill mt-3" href="../vistas/libreria/catalogo.php"> Volver </a>
      </div>
    </div>
  </div>
</body>

</html>