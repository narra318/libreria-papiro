  <?php
  session_start();
  include_once "../../controller/conexion.php";
  $conexion = new Configuracion();
  $con = $conexion->conectarDB();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    include '../../controller/seguridad.php';
        $encriptar = new Seguridad();
        $pwd = $encriptar->encriptarP($_POST["pwd"]);
        $cpwd = $encriptar->encriptarP($_POST["cpwd"]);
   
    if ($pwd == $cpwd) {
      $reset_pwd = mysqli_query($con, "UPDATE usuario SET contrasenaUsuario='$pwd' WHERE correoUsuario='$email'");
      if ($reset_pwd > 0) {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Tu contraseña ha sido actualizada exitosamente.
        <br>
        <a href="../../vistas/usuario/index.php"><b>Haz click aquí para iniciar sesión</b></a>
      </div>';
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       Error al actualizar la tabla.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       Las contraseñas no coinciden
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
  }

  if (isset($_GET['secret'])) {
    $email = base64_decode($_GET['secret']);
    $check_details = mysqli_query($con, "SELECT correoUsuario FROM usuario WHERE correoUsuario='$email'");
    $res = mysqli_num_rows($check_details);
    if ($res > 0) {
      // Agrega aquí el código para enviar un correo electrónico de confirmación o redireccionar a la página de inicio de sesión.
    } else {
      $msg = "No se pudo encontrar un usuario con ese correo electrónico.";
    }
  }
  ?>

  <!DOCTYPE html>

  <html lang="es">

  <head>
    <title> reescribir Contraseña </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Este formulario es el inicio de sesion de los usuarios, para acceder a las funciones de la libreria.">
    <link rel="shortcut icon" href="../../img/icono2.png" type="image/ico" />
    <link rel="apple-touch-icon" href="../../img/icono2.png">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/login_reg.css">
    <link href="../../libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>

    </style>
  </head>

  <body class="bg-secondary">
    <?php include '../../modules/menu-footer.php'; ?>
    <?= menu("../.."); ?>

    <div class="body">
      <!-- Formulario -->
      <div class="containerLogin p-5 mt-5 mb-5" style="width: 35em;">
        <p class="error"><?php if (!empty($msg)) {
                            echo $msg;
                          } ?></p>
        <div class="container-fluid text-center text-white mt-5 p-2">

          <h1 id="Titulo1"> Restablecer Contraseña </h1>
        </div>

        <form id="validate_form" class="ms-2 me-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <input type="hidden" name="email" value="<?php echo $email; ?>" />
          <div class="form-floating m-4">
            <input type="password" name="pwd" id="pwd" placeholder="Ingrese la contraseña" required  class="form-control bg-secondary bg-opacity-75 text-dark border-bottom border-primary" />
            <label for="pwd" style="color: var(--primary)"> <i class="bi bi-lock-fill"></i>Contraseña:</label>
          </div>



          <div class="form-floating m-4">
            <input type="password" name="cpwd" id="cpwd" placeholder="Ingrese nuevamente la contraseña" required  class="form-control bg-secondary bg-opacity-75 text-dark border-bottom border-primary" />
            <label for="cpwd" style="color: var(--primary)"> <i class="bi bi-lock-fill"></i>Confirmar Contraseña:</label>
          </div>
          <div class="text-end mt-5 mb-4">
            <button type="submit" class="btn btn-outline-primary rounded ms-4 me-4  border border-primary" id="login" name="pwdrst"> Ingresar <i class="bi bi-arrow-right ms-2"></i></button>

          </div>


        </form>
      </div>
    </div>


    <?= footer(); ?>
    <script src="../../js/bootstrap.bundle.min.js"> </script>
  </body>

  </html>