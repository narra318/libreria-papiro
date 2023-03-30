<!DOCTYPE html>
<html lang="es">

<head>
    <title> Restablecer Contraseña </title>
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
</head>

<body class="bg-secondary">
    <?php include '../../modules/menu-footer.php'; ?>
    <?= menu("../.."); ?>

    <div class="body">
        <!-- Formulario -->
        <div class="containerLogin p-5 mt-5 mb-5" style="width: 35em;">
            <div class="container-fluid text-center text-white mt-5 p-2">
                <h1 id="Titulo1"> Ingresa tu Correo </h1>
            </div>

            <form action="restablecer_contrasena.php" class="ms-2 me-2" method="POST">
                <div class="form-floating m-4">
                    <input type="email" class="form-control bg-secondary bg-opacity-75 text-dark border-bottom border-primary" id="email" placeholder="Ingrese su email" name="email" required>
                    <label for="email" style="color: var(--primary)"> <i class="bi bi-envelope"></i> Correo electrónico:</label>
                </div>

                <div class="text-end mt-5 mb-4">
                    <a type="button" href="../../vistas/usuario/index.php" class="btn btn-outline-primary rounded ms-4 me-4  border border-primary"> Volver <i class="bi bi-arrow-left ms-2"></i></a>
                    <button type="submit" class="btn btn-outline-primary rounded ms-4 me-4  border border-primary"> Enviar Instrucciones <i class="bi bi-arrow-right ms-2"></i></button>

                </div>
                <?php

                use PHPMailer\PHPMailer\PHPMailer;

                include_once "../../controller/conexion.php";
                $conexion = new Configuracion();
                $con = $conexion->conectarDB();

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $_POST['email'];

                    $check_email = "SELECT correoUsuario FROM usuario WHERE correoUsuario='$email'";
                    $res = $con->query($check_email);
                    if (!$check_email) {
                        die(mysqli_error($con));
                    } elseif ($res->num_rows > 0) {
                        $message = '<div style="background-color: #f2f2f2; padding: 20px;">
                        <p style="font-size: 18px; font-weight: bold;">¡Hola!</p>
                        <p style="font-size: 16px;">Estás recibiendo este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.</p>
                        <br>
                        <p><button style="background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;"><a style="color: white; text-decoration: none;" href="http://localhost/libreria/codigo/usuario/reescribir_contrasena.php?secret=' . base64_encode($email) . '">Restablecer Contraseña</a></button></p>
                        <br>
                        <p style="font-size: 16px;">Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna otra acción.</p>
                    </div>';


                        require '../PhpMailer/Exception.php';
                        require '../PhpMailer/PHPMailer.php';
                        require '../PhpMailer/SMTP.php';

                        $mail = new PHPMailer(true);


                        $mail->SMTPDebug = 0;
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "tls";
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;

                        $mail->Username = "libreriapapiro2023@gmail.com";
                        $mail->Password = "ylzvhefqlmcyohlm";

                        $mail->setFrom('libreriapapiro2023@gmail.com', 'libreria');
                        $mail->AddAddress($email);

                        $mail->isHTML(TRUE);
                        $mail->Subject = "Libreria Papiro";
                        $mail->Body = $message;

                        if ($mail->send()) {




                            $msg = "<html><head><style>
                                .message-container p {
                                    font-size: 16px;
                                    line-height: 1.5;
                                    margin-bottom: 10px;
                                    color: black !important;
                                }
                                
                                .message-container a {
                                    display: inline-block;
                                    padding: 10px 20px;
                                    background-color: #88456a;
                                    color: #fff;
                                    text-decoration: none;
                                    border-radius: 5px;
                                    margin-top: 10px;
                                }
                                
                                .message-container a:hover {
                                    background-color: #6d344e;
                                }
                                </style></head><body>
                                <div class='message-container'>
                                    <p><b>¡Hola!</b></p>
                                    <p>Estás recibiendo este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.</p>
                                    <br>
                                    <p><a href='http://localhost/libreria/codigo/usuario/reescribir_contrasena.php?secret=' . base64_encode($email) . ''>Restablecer Contraseña</a></p>
                                    <br>
                                    <p>Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna otra acción.</p>
                                </div></body></html>";

                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . $msg;
                            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                        }
                    } else {
                        $msg = "No podemos encontrar un usuario con esa dirección de correo electrónico";
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" . $msg;
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    }
                }
                ?>
            </form>
        </div>
    </div>

    <?= footer(); ?>
    <script src="../../js/bootstrap.bundle.min.js"> </script>
</body>

</html>