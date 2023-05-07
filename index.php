<?php ob_start();
session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Inicio </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Iniciio general de la página, aqui se escuentran libros, descripciones generales y más.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/icono2.png" type="image/ico" />
    <link rel="apple-touch-icon" href="./img/icono2.png">
    <link rel="stylesheet" href="./css/custom.css">
    <script src="./js/bootstrap.bundle.min.js"> </script>
    <link rel="stylesheet" href="css/style.css">
    <link href="./libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card:hover {
            animation: shadow-pop-top-right 0.5s linear both;
        }

        @keyframes shadow-pop-top-right {
            0% {
                box-shadow: 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542, 0 0 #4a3542;
                transform: translateX(0) translateY(0);
            }

            100% {
                border: #4a3542 0.5px solid;
                box-shadow: 1px -1px #4a3542, 2px -2px #4a3542, 3px -3px #4a3542, 4px -4px #4a3542, 5px -5px #4a3542, 6px -6px #4a3542, 7px -7px #4a3542, 8px -8px #4a3542;
                transform: translateX(-8px) translateY(8px);
            }
        }

        @keyframes neon {
            0% { text-shadow: 0 0 30px white, 0 0 35px white, 0 0 30px white; }
            100% { text-shadow: 0 0 5px white, 0 0 10px white, 0 0 20px white, 0 0 30px white, 0 0 40px white, 0 0 50px white, 0 0 60px white, 0 0 70px white; }
        }

        .neon-text:hover {
            animation: neon 1.5s ease-in-out infinite alternate;
        }
    </style>
</head>

<body class="bg-secondary">
    <?php include './modules/menu-footer.php'; ?>
    <?= menu("."); ?>

    <div class="container p-5 overflow-auto">
        <div class="row overflow-auto">
            <div class="col-md-8">
                <p class="neon-text fw-semibold d-none d-lg-block border border-info bg-info bg-opacity-25 rounded text-primary p-5" style="font-size: 30px;">
                    <i class="bi bi-quote"></i>
                    Gracias por la obra de arte que eres tú, porque tu sola existencia es arte.
                </p>

                <h1 class="mt-5 text-center"> Bienvenid@ a la Libreria Papiro ઇઉ </h1>
                <h3 class="fw-normal text-center" style="color: #35393c;"> Te dejamos algunas recomendaciones... </h3>

                <!-- Slider -->
                <div class="ps-0 p-4">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./img/slider-libros/slider21.jpg" class="d-block w-100" alt="Libro de Claudia Hérnandez - Tomar tu mano">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/slider-libros/slider22.jpg" class="d-block w-100" alt="Libro de Luis Carlos Barragán - Parasitos Perfectos">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/slider-libros/slider23.jpg" class="d-block w-100" alt="Libro Panza de Burro de Andrea Abreu">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/slider-libros/slider24.jpg" class="d-block w-100" alt="Libro Fiebre Tropical de Juli Delgado Lopera">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/slider-libros/slider25.jpg" class="d-block w-100" alt="Libro Más Alla Del Canto de Martha Senn">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"> Atras </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-4 justify-content-center text-center pb-4">
                <!-- Boton con la imagen -->
                <button type="button" class="btn d-none d-md-block rounded h-100 w-100" style="background-image:url(./img/portada/ojala.png);background-repeat:no-repeat;background-position:center;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img class="ratio d-none d-md-block" src="./img/portada/ojala.png" style="border-radius: 10px; mask-image: radial-gradient(white, transparent);" width="400" alt="Portada de libro Ojalá de Defreds">
                </button>
                
                <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 mx-auto" id="staticBackdropLabel"> Ojalá - Defreds </h1>
                                    <div class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Editorial: Espasa <br>
                                        Temática: Poesía | Poesía urbana <br>
                                        Colección: ESPASAesPOESÍA <br>
                                        Número de páginas: 168
                                    </p>

                                    <div class="text-start pt-3 pb-3 p-5">
                                        <!-- <b> Sinopsis: </b>  -->
                                        <h4 class="fw-normal"> Una inspiradora «pandilla planetaria» que gira alrededor de los sentimientos </h4>
                                        <h5 class="fw-normal"> Esta novedosa propuesta de Defreds sorprenderá con un ejemplar artístico en el que destacan las ilustraciones de Lady Desidia y unas hermosas caligrafías que dan forma a su pensamiento. El libro está compuesto de distintos apartados, cada uno protagonizado por un planeta, como un personaje con sus cualidades y defectos, con marcados rasgos de personalidad, sus filias y fobias. Y a partir de ellos nos narra emociones y experiencias vitales que nos interpelan: una representación del mundo caótico que nos toca en suerte y en el que tanta falta hacen los afectos. Un cuento del siglo XXI en el que se habla de personalidades diferentes, como una “panda planetaria” que se enfrenta a cada día; y como siempre de ternura, de amistad, de pasión; de la infancia, la paternidad, la alegría y la tristeza, de la esperanza en un mundo mejor, con el convencimiento de que en el amor radica el verdadero sentido de las cosas. Un cuento universal e inspirador para los lectores de hoy y en especial para los incondicionales de Defreds que sabrán apreciar su delicadeza y sentimiento. Calará en el corazón de todos. </h5>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary rounded fw-normal" data-bs-dismiss="modal"> Cerrar </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Fin del modal -->
            </div>
        </div>


        <?php
        $xml = simplexml_load_file('recomendacion.xml');

        // Obtener los libros de poesía y contemporaneo
        $poesiaLibros = $xml->poesia->libro;
        $contemporaneoLibros = $xml->contemporaneo->libro;
        ?>

        <div class="pt-5">
            <h1 class="text-center">Libros de Poesía</h1>
            <div class="row mt-5">
                <?php
                $libroIndex = 0;
                foreach ($poesiaLibros as $libro) :
                ?>
                    <div class="col-md-3 card-group p-0 rounded">
                        <div class="card rounded text-secondary p-3" style="background-color: #6f636e; border: #4a3542 solid 1px;">
                            <img src="<?php echo $libro->img; ?>" class="card-img-top h-100" alt="Portada <?php echo $libro->titulo, '-', $libro->autor; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $libro->titulo; ?></h5>
                                <p class="card-text">Autor: <?php echo $libro->autor; ?></p>
                                <p class="card-text text-end">
                                    <button type="button" class="btn btn-secondary rounded p-2 pe-3 ps-3" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $libroIndex; ?>">Ver más..</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php $libroIndex++; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Inicio del modal poesia -->
            <?php
                $libroIndex = 0; // Reiniciar el índice del libro
                foreach ($poesiaLibros as $libro) :
            ?>
                <div class="modal fade text-center" id="modal-<?php echo $libroIndex; ?>" tabindex="-1" aria-labelledby="modal-<?php echo $libroIndex; ?>-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 mx-auto" id="modal-<?php echo $libroIndex; ?>-label"><?php echo $libro->titulo, '-', $libro->autor; ?></h1>
                                <div class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Editorial: <?php echo $libro->editorial; ?> <br>
                                    Temática: <?php echo $libro->tematica; ?> <br>
                                    Colección: <?php echo $libro->coleccion; ?> <br>
                                    Número de páginas: <?php echo $libro->paginas; ?>
                                </p>
                                <div class="text-start pt-3 pb-3 p-5">
                                    <p class="text-dark"><?php echo $libro->des; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $libroIndex++; ?>
            <?php endforeach; ?>
        <!-- Fin del modal poesia -->


        <div class="pt-5">
            <h1 class="text-center">Libros contemporáneos</h1>
            <div class="row mt-5">
                <?php
                $libroIndex = 0; // Variable para llevar el control del índice del libro
                foreach ($contemporaneoLibros as $libro) :
                ?>
                    <div class="col-md-3 card-group p-0 rounded">
                        <div class="card rounded text-secondary p-3" style="background-color: #6f636e; border: #4a3542 solid 1px;">
                            <img src="<?php echo $libro->img; ?>" class="card-img-top h-100" alt="Portada <?php echo $libro->titulo, '-', $libro->autor; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $libro->titulo; ?></h5>
                                <p class="card-text"> <?php echo $libro->autor; ?></p>
                                <p class="card-text text-end">
                                    <button type="button" class="btn btn-secondary rounded p-2 pe-3 ps-3" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $libroIndex; ?>">Ver más..</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php $libroIndex++; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Inicio del modal contemporáneo -->
            <?php
            $libroIndex = 0; // Reiniciar el índice del libro
            foreach ($contemporaneoLibros as $libro) :
            ?>
                <div class="modal fade text-center" id="modal-<?php echo $libroIndex; ?>" tabindex="-1" aria-labelledby="modal-<?php echo $libroIndex; ?>-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 mx-auto" id="modal-<?php echo $libroIndex; ?>-label"><?php echo $libro->titulo, '-', $libro->autor; ?></h1>
                                <div class="text-end"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Editorial: <?php echo $libro->editorial; ?> <br>
                                    Temática: <?php echo $libro->tematica; ?> <br>
                                    Colección: <?php echo $libro->coleccion; ?> <br>
                                    Número de páginas: <?php echo $libro->paginas; ?>
                                </p>
                                <div class="text-start pt-3 pb-3 p-5">
                                    <p><?php echo $libro->des; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $libroIndex++; ?>
            <?php endforeach; ?>
        <!-- Fin del modal contemporáneo -->
    </div>

    <?= footer(); ?>
</body>

</html>