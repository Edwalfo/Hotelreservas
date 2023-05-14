<script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
<link rel="icon" href="<?php echo SERVERURL; ?>vistas/images/logo.jpg" type="image/jpg">
<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/pagina.css">

<!-- header -->
<header class="header" id="header">
    <div class="head-top">
        <div class="site-name">
            <span>Hotel Mark-1</span>
        </div>
        <div class="site-nav">
            <span id="nav-btn">MENU <i class="fas fa-bars"></i></span>
        </div>
    </div>




    <div class="head-bottom flex">

        <div class="mb-3">

            <?php
            $pag = explode("/", $_GET['views']);

            require_once "./controladores/reservaControlador.php";
            $ins_reserva = new reservaControlador;
            $datos_reserva = $ins_reserva->datos_reserva_controlador("unico", $pag[1]);
            $campos = $datos_reserva->fetch();

            if ($datos_reserva->rowCount() == 1) {

            ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4">
                        <div class="card text-start bg-dark text-warning border-warning">

                            <div class="card-body p-5 s">
                                <h4 class="card-title text-center text-bold"><strong>Datos reserva</strong></h4>
                                <div class="row">

        
                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold">Codigo:</h5>
                                        <h5 class="text-light fw-bold"><?php echo $campos['numeroReserva'] ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold">Nombre:</h5>
                                        <h5 class="text-light fw-bold"><?php echo $campos['nombreHuesped'] ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold"><?php echo $campos['nombreTipoDocumento'] ?>:</h5>
                                        <h5 class="text-light fw-bold"><?php echo $campos['documentoHuesped'] ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold">Nº habitación:</h5>
                                        <h5 class="text-light fw-bold"><?php echo $campos['numeroHabitacion'] ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold">Tipo habitación:</h5>
                                        <h5 class="text-light fw-bold"><?php echo $campos['nombreTipoHabitacion'] ?></h5>
                                    </div>

                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold">Fecha ingreso:</h5>
                                        <h5 class="text-light fw-bold"><?php echo $campos['fecha_ingreso'] ?></h5>
                                    </div>

                                    <div class="d-flex justify-content-between col-md-12">
                                        <h5 class="text-warning fw-bold">Fecha Salida:</h5>
                                        <h5><h5 class="text-light fw-bold"><?php echo $campos['fecha_salida'] ?></h5></h5>
                                    </div>
                                    <a type="button" class="btn btn-warning rounded-0" href="<?php echo SERVERURL; ?>pagina/">Volver</a>

                                </div>




                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>





        </div>
</header>
<!-- end of header -->

<!-- side navbar -->
<div class="sidenav" id="sidenav">
    <span class="cancel-btn" id="cancel-btn">
        <i class="fas fa-times"></i>
    </span>

    <ul class="navbar">
        <li><a href="../pagina">inicio</a></li>
        <li><a href="#services">servicios</a></li>
        <li><a href="#rooms">habitaciones</a></li>
        <li><a href="#customers">Clientes</a></li>
    </ul>
    <button class="btn log-in">Iniciar sesión</button>
</div>
<!-- end of side navbar -->

<!-- fullscreen modal -->
<div id="modal"></div>
<!-- end of fullscreen modal -->

<!-- body content  -->
<!--end body content  -->

<!-- pie de página -->
<footer class="footer">
    <div class="footer-container">
        <div>
            <h2>Sobre nosotros </h2>
            <p>Somos una organización fundada por dos estudiantes para pasar la materia del profesor Ferney.</p>
            <ul class="social-icons">
                <li class="flex">
                    <i class="fa fa-twitter fa-2x"></i>
                </li>
                <li class="flex">
                    <i class="fa fa-facebook fa-2x"></i>
                </li>
                <li class="flex">
                    <i class="fa fa-instagram fa-2x"></i>
                </li>
            </ul>
        </div>

        <div>
            <h2>Enlaces</h2>
            <a href="#">Blog</a>
            <a href="#">habitaciones</a>
            <a href="#">Subscripción</a>
            <a href="#">tarjeta de regalo</a>
        </div>


        <div>
            <h2>Privacidad</h2>
            <a href="#">Carrera profesional</a>
            <a href="#">Sobre nosotros</a>
            <a href="#">Contáctenos</a>
            <a href="#">Servicios</a>
        </div>

        <div>
            <h2>Dudas e Inquietudes </h2>
            <div class="contact-item">
                <span>
                    <i class="fas fa-map-marker-alt"></i>
                </span>
                <span>
                    Buenaventura - Valle del cauca en la finca de don jhon pregunte por el dueño
                </span>
            </div>
            <div class="contact-item">
                <span>
                    <i class="fas fa-phone-alt"></i>
                </span>
                <span>
                    +57 3168535950
                </span>
            </div>
            <div class="contact-item">
                <span>
                    <i class="fas fa-envelope"></i>
                </span>
                <span>
                    jaarboleda@unipacifico.edu.co
                </span>
            </div>
        </div>
    </div>
</footer>
<!-- fin del pie de página -->
<script src="<?php echo SERVERURL; ?>vistas/js/pagina.js"></script>