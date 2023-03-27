<?php
    function menu($img){
    echo <<<EOT
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark sticky-top border-bottom border-info p-2">
            <div class="container-fluid">
                <a class="navbar-brand ms-2" href="http://localhost/Libreria/" target="_self"> <img src="$img/img/icono.png" style="height:35px;" alt="Icono de mariposa" style="width: 100%; min-width: 20%"> </a>
                <a class="navbar-brand" href="http://localhost/Libreria/" style="color: #b97f9f;"> Libreria Papiro ઇઉ </a>
            
                <button class="navbar-toggler" aria-label="Boton del menu desplegable" type="button" data-bs-toggle="collapse" data-bs-target="#menuR"> 
                    <span class="navbar-toggler-icon"> </span>
                </button>
            
                <div class="collapse navbar-collapse justify-content-end" id="menuR">
                    <ul class="navbar-nav me-3">
                        <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/"> <i class="bi bi-house-heart me-1"> </i> Inicio </a> </li>
                        <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/vistas/libreria/libreria.php"> <i class="bi bi-building me-1"> </i> Nosotros </a> </li>
                        <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/vistas/libreria/catalogo.php"> <i class="bi bi-journal-richtext me-1"> </i> Catálogo </a> </li>
                        <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/vistas/libreria/foros.php"> <i class="bi bi-textarea-resize me-1"> </i> Foros </a> </li>
        EOT;   

          if(!isset($_SESSION['Status'])){
            echo  '<li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/vistas/usuario/"> <i class="bi bi-person me-1"> </i> Usuario </a> </li>';
          }else{
            echo '<li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/vistas/usuario/"> <i class="bi bi-person-circle me-1"></i>'.  $_SESSION['Status'] .'</a> </li>';
          }

        echo <<<EOT
                    </ul>
                </div>
            </div>
        </nav>

        EOT;
        
    };

    function footer(){
    echo <<<FOOTER
        <footer class="footer-16371 bg-primary">
              <div class="container pt-3">
                <div class="row justify-content-center">
                  <div class="col-md-9 text-center">
                    <div class="footer-site-logo mb-4">
                      <a href="http://localhost/Libreria/" style="font-family: Hand;">Libreria Papiro </a>
                    </div>
                    <ul class="list-unstyled nav-links mb-3">
                      <li><a href="http://localhost/Libreria/vistas/libreria/catalogo.php">Catálogo</a></li>
                      <li><a href="http://localhost/Libreria/vistas/libreria/libreria.php">Nosotros</a></li>
                      <li><a href="http://localhost/Libreria/vistas/libreria/foros.php">Foros</a></li>
                      <li><a href="http://localhost/Libreria/vistas/usuario/logeado/index.php">Usuario</a></li>
                    </ul>
        
                    <div class="social">
                      <ul class="list-unstyled">
                        <li class="in"><a href="https://instagram.com/" aria-label="Icono de Instagram" target="_blank"><span class="bi bi-instagram" ></span></a></li>
                        <li class="fb"><a href="https://facebook.com/" aria-label="Icono de Facebook" target="_blank"><span class="bi bi-facebook"></span></a></li>
                        <li class="tw"><a href="https://twitter.com/" aria-label="Icono de Twitter" target="_blank"><span class="bi bi-twitter"></span></a></li>
                        <li class="pin"><a href="https://pinterest.com/" aria-label="Icono de Pinterest" target="_blank"><span class="bi bi-pinterest"></span></a></li>
                        <li class="dr"><a href="https://dribbble.com/" aria-label="Icono de Dribbble" target="_blank"><span class="bi bi-dribbble"></span></a></li>
                      </ul>
                    </div>
        
                    <div class="copyright pb-3">
                      <p class="mb-0"><small>&copy; 2022 - Copyright all rights reserved ||<br>
                                                            Julian Lopez - Nikol Ramírez</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </footer>
            
        FOOTER;
    };

    function menuAdmin($img){
    echo
      <<< MENUADMIN
        <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top border-bottom border-info p-2">
          <div class="container-fluid">
      
            <a class="navbar-brand ms-2" href="http://localhost/Libreria/admin/vistas/inicio.php" target="_self"> <img src="$img/img/icono2.png" alt="Icono de mariposa" style="width: 100%; min-width: 20%"> </a>
            <a class="navbar-brand text-secondary" href="http://localhost/Libreria/admin/vistas/inicio.php"> Libreria Papiro - Administrador ઇઉ </a>
      
              <button class="navbar-toggler"  aria-label="Boton del menu desplegable"  type="button" data-bs-toggle="collapse" data-bs-target="#menuR"> 
                  <span class="navbar-toggler-icon"> </span>
              </button>
      
              <div class="collapse navbar-collapse justify-content-end" id="menuR">
                  <ul class="navbar-nav me-3">
                      <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/admin/vistas/pedidos/"> <i class="bi bi-bag-plus me-1"> </i> Pedidos </a> </li>
                      <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/admin/vistas/usuario/"> <i class="bi bi-person-rolodex me-1"> </i> Usuarios </a> </li>
                      <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/admin/vistas/inventario/"> <i class="bi bi-journals me-1"> </i> Inventario </a> </li>
      
                      <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/admin/vistas/foro/"> <i class="bi bi-body-text me-1"> </i> Foros </a> </li>
                      <li class="nav-item"> <a class="nav-link me-2" href="http://localhost/Libreria/admin/codigo/controller/logout.php"> <i class="bi bi-door-closed-fill me-1"> </i> Cerrar Sesión </a> </li>
                  </ul>
              </div>
          </div>
        </nav>

      MENUADMIN;
    };

    function BarraBusqueda(){
      echo
        <<<BarraBusqueda
          <div class="col-md-8 mx-auto" id="barra-busqueda">
            <form class="input-group mb-3" id="formulario" action="" method="get">
                <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar" aria-describedby="btnBuscar">
                <button type="button" id="btnBuscar" class="btn btn-primary " onclick="buscar()"> Buscar </button>
            </form>
          </div>
        BarraBusqueda;
    };

    function menuSide($status1,$status2,$status3,$status4, $img){
      $van = $_SESSION['Status'];
      echo
          <<<MENU
              <div class="d-flex flex-column flex-shrink-0 p-3 pb-0 text-white bg-primary" style=" width: 20vw; height: 100%;">
              
                  <img src="$img/img/iconoooo.png"  alt="perrito con mariposas">
                  <hr>
                  <ul class="nav nav-pills flex-column mb-auto">
                      <li class="nav-item menu-side">
                          <a href="http://localhost/Libreria/vistas/usuario/logeado/" class="nav-link menuu text-white $status1"> Foros </a>
                      </li>
                      <li class="nav-item menu-side">
                          <a href="http://localhost/Libreria/carrito/VerCarta.php" class="nav-link text-white $status2 menuu"> Carrito de compras </a>
                      </li>
                      <li class="nav-item menu-side">
                          <a href="http://localhost/Libreria/carrito/compras.php" class="nav-link text-white $status3 menuu"> Compras </a>
                      </li>
                      <li class="nav-item menu-side">
                          <a href="http://localhost/Libreria/carrito/infEnvio.php" class="nav-link text-white $status4 menuu"> Información de envio </a>
                      </li>
                  </ul>
              </div>
          MENU;
      }
?>