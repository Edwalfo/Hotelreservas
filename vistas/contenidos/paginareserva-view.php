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


            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card text-start bg-dark text-warning">

                        <div class="card-body p-5 ">
                            <h4 class="card-title text-center text-bold"><strong>Reservar Habitación</strong></h4>
                            <h6 class="text-center text-light">Diligencie el siguiente formulario para registrar su reserva.</h6>
                            <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/reservaAjax.php" data-form="save" autocomplete="on">
                                <h5>Datos personales</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">

                                            <input type="text" class="form-control" name="input-huespedNombre2" id="input-huespedNombre2" placeholder="Nombre" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="input-tipoDocumento2" class="form-label">Tipo documento</label>
                                            <select class="form-select" name="input-tipoDocumento2" id="input-tipoDocumento2" required>
                                                <?php
                                                require_once "./controladores/tipodocumentoControlador.php";
                                                $ins_tipodocumento = new tipodocumentoControlador;

                                                echo $ins_tipodocumento->generar_tiposdocumento_controlador('add')
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">

                                            <input type="text" class="form-control" name="input-nDocumento2" id="input-nDocumento2" placeholder="Numero documento" maxlength="15" pattern="[0-9+]{1,15}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">

                                            <input type="text" class="form-control" name="input-fNacimiento2" id="input-fNacimiento2" placeholder="Fecha nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">

                                            <input type="text" class="form-control" name="input-Direccion2" id="input-Direccion2" placeholder="Dirección (Opcional)" maxlength="60" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,60}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">

                                            <input type="text" class="form-control" name="input-Telefono2" id="input-Telefono2" placeholder="Teléfono (Opcional)" maxlength="45" pattern="[0-9()+]{8,20}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">

                                            <input type="email" class="form-control" name="input-correo2" id="input-correo2" placeholder="Correo" maxlength="45">
                                        </div>
                                    </div>
                                    <h5>Datos alojamiento</h5>

                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <input class="form-control " type="Text" name="inputcheckin2" id="inputcheckin2" placeholder="Ingreso" onfocus="(this.type='date')" onblur="(this.type='text')" min="<?php echo date('Y-m-d') ?>" required>

                                        </div>
                                    </div>
                                    <div class="col-md-6 bg-">
                                        <div class="mb-3">
                                            <input class="form-control  " type="Text" name="inputcheckout2" id="inputcheckout2" placeholder="Salida" onfocus="(this.type='date')" onblur="(this.type='text')" min="<?php echo date('Y-m-d') ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="input-tipoHab2" class="form-label">Tipo habitación</label>
                                            <select class="form-select" name="input-tipoHab2" id="input-tipoHab2">
                                                <?php
                                                require_once "./controladores/tipoHabitacionControlador.php";
                                                $ins_tipoHabitacion = new tipoHabitacionControlador;

                                                echo $ins_tipoHabitacion->generar_tiposhabitacion_controlador('add')
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3 bg-light">
                                            <div class="row m-0">
                                                <div class="col">
                                                    <h6 class="text-dark">Costo alojamiento</h6>
                                                    <h6 id="text-res" class="text-primary fw-bold"></h6>
                                                    <hr class="text-dark">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <h5>Pago</h5>
                                    <div class="col-md-12">

                                        <div class="mb-3">
                                            <input class="form-control" type="Text" name="input-nombre-tarjeta" id="input-nombre-tarjeta" placeholder="Nombre del titular de la tarjeta" required>

                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="mb-3">
                                            <input class="form-control" type="number" name="input-numero-tarjeta" id="input-numero-tarjeta" placeholder="Número de la tarjeta de crédito/débito" required>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input class="form-control" type="Text" name="input-fecha-vencimiento" id="input-fecha-vencimiento" placeholder="Fecha de vencimiento" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <input class="form-control" type="number" name="input-codigo-seguridad" id="input-codigo-seguridad" placeholder="Codigo de seguridad" required>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex">
                                            <a type="button" class="btn btn-secondary rounded-0" href="<?php echo SERVERURL; ?>pagina/">Cancelar</a>
                                            &nbsp;
                                            <button type="submit" class="btn btn-warning rounded-0">Reservar</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>





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