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
        <h2>Bienvenidos al Hotel Mark-1</h2>
        <p>Disfruta de nuestras maravillosas habitaciones orientadas al descanso y la relajación, hacemos lo mejor pensando solo en tu satisfaccion asi que no te preocupes y déjalo todo en nuestras manos, disfruta de experiencias con tus amigos, familiares, pareja o incluso solo. En esta página Podrás tener acceso a todas nuestras habitaciones solo elige tu preferida para y luego disfruta de la paz y satisfacción.
            "Qué esperas estás a solo un click"</p>
        
        <a class="btn btn-warning btn-lg rounded-0" href="<?php echo SERVERURL ?>paginareserva/" role="button">Reservar habitación</a>
        

    </div>


</header>
<!-- end of header -->

<!-- side navbar -->
<div class="sidenav" id="sidenav">
    <span class="cancel-btn" id="cancel-btn">
        <i class="fas fa-times"></i>
    </span>

    <ul class="navbar">
        <li><a href="./pagina">inicio</a></li>
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
<section class="services sec-width" id="services">
    <div class="title">
        <h2>services</h2>
    </div>
    <div class="services-container">
        <!-- single service -->
        <article class="service">
            <div class="service-icon">
                <span>
                    <i class="fas fa-utensils"></i>
                </span>
            </div>
            <div class="service-content">
                <h2>Servicio y alimentos</h2>
                <p>Nos encargamos de la preparación y cocción de los alimentos cumpliendo con estrictas normas sanitarias en la manipulación de los alimentos y las condiciones de higiene del personal que labora en una cocina.</p>
            </div>
        </article>
        <!-- end of single service -->
        <!-- single service -->
        <article class="service">
            <div class="service-icon">
                <span>
                    <i class="fas fa-swimming-pool"></i>
                </span>
            </div>
            <div class="service-content">
                <h2>Relajación acuática</h2>
                <p>Contamos con habitaciones con yacusi donde podrás relajarte y dejar fluir todas tus preocupaciones mientras descansas ya sea solo o en pareja</p>
            </div>
        </article>
        <!-- end of single service -->
        <!-- single service -->
        <article class="service">
            <div class="service-icon">
                <span>
                    <i class="fas fa-broom"></i>
                </span>
            </div>
            <div class="service-content">
                <h2>Limpieza</h2>
                <p>Tenemos profesionales en el área dela limpieza, encargados de mantener nuestras instalaciones en el mejor estado posible para su uso</p>
            </div>
        </article>
        <!-- end of single service -->
        <!-- single service -->
        <article class="service">
            <div class="service-icon">
                <span>
                    <i class="fas fa-door-closed"></i>
                </span>
            </div>
            <div class="service-content">
                <h2>Seguridad de la habitación</h2>
                <p>Diseñamos habitaciones de seguridad personalizadas, que permiten a nuestro cliente permanecer en una zona protegida durante un tiempo determinado. Sus características las convierten en zonas también especialmente indicadas para proteger información sensible y objetos de valor.</p>
            </div>
        </article>
        <!-- end of single service -->
    </div>
</section>


<section class="rooms sec-width" id="rooms">
    <div class="title">
        <h2>Habitaciones</h2>
    </div>
    <div class="rooms-container">
        <!-- familiar -->
        <article class="room">
            <div class="room-image">
                <img src="<?php echo SERVERURL; ?>vistas/images/img1.jpg" alt="room image">
            </div>
            <div class="room-text">
                <h3>Habitacion de familiar</h3>

                <p>Tanto por el estilo de su mobiliario como de su decoración. Aunque pueda parecer que tener un dormitorio tan elegante puede ser muy caro, en realidad no hace falta hacer un desembolso de dinero superior al necesario para relajarte en cualquier habitación. Con un aspecto elegante contamos con contamos con habitaciones de bajos precios como la habitación familiar desde</p>
                <p class="rate">
                    <span>$99.00 /</span> por noche
                </p>

                <a type="button" href="<?php echo SERVERURL; ?>paginareserva/" class="btn btn-warning
                     ms-4 rounded-0">Resevar </a>
            </div>
        </article>
        <!-- fin de familiar -->
        <!-- single pareja -->
        <article class="room">
            <div class="room-image">
                <img src="<?php echo SERVERURL; ?>vistas/images/img4.jpg" alt="room image">
            </div>
            <div class="room-text">
                <h3>Especial para Parejas </h3>

                <p>Contamos con habitaciones insonorizadas para que disfrutes al máximo con tu pareja, dejen fluir la llama de la pación en nuestra especial para parejas</p>
                <p class="rate">
                    <span>$199.00 /</span> Por noche
                </p>
                <a type="button" href="<?php echo SERVERURL; ?>paginareserva/" class="btn btn-warning
                     ms-4 rounded-0">Resevar </a>
            </div>
        </article>
        <!-- fin de pareja -->
        <!-- habitacion sencilla -->
        <article class="room">
            <div class="room-image">
                <img src="<?php echo SERVERURL; ?>vistas/images/img3.jpg" alt="room image">
            </div>
            <div class="room-text">
                <h3>Aparta estudio</h3>

                <p>Si estas en un viaje de negocio en estos cuartos podrás relajarte asegúrate de dar lo mejor de ti sin desgastarte demasiado y trabajar sin problemas ni inconvenientes </p>
                <p class="rate">
                    <span>$79.00 /</span> Por noche
                </p>
                <a type="button" href="<?php echo SERVERURL; ?>paginareserva/" class="btn btn-warning
                     ms-4 rounded-0">Resevar </a>
            </div>
        </article>
        <!-- fin de la habitacion sencilla-->
    </div>
</section>


<section class="customers" id="customers">
    <div class="sec-width">
        <div class="title">
            <h2>comentarios de algunos nuestros clientes más famosos</h2>
        </div>
        <div class="customers-container">
            <!-- comentario de jakc sparro-->
            <div class="customer">
                <div class="rating">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                </div>
                <h3>Excelentes instalaciones</h3>
                <p>Me encanta hay mas de 30 habitaciones estándar y cada una de ellas tiene: baño en suite, aire acondicionado y calefacción central, teléfono, conexión a Internet, correo de voz, TV satelital, películas, radio y canales internos de música, minibar, caja de seguridad y secador de cabello. Las habitaciones tienen mucho espacio para circular y están alfombradas y decoradas en tonos cálidos. Tienen un toque acogedor y cortinas que no dejan entrar la luz y almohadones.</p>
                <img src="<?php echo SERVERURL; ?>vistas/images/johnny.webp" alt="customer image">
                <span>Johnny Depp</span>
            </div>
            <!-- final del capitan-->
            <!-- comentario de toni stak-->
            <div class="customer">
                <div class="rating">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                </div>
                <h3>Confortable y cómodo</h3>
                <p>Uno de los puntos más positivos sobre el Hotel mark-1 es su atención excepcionalmente servicial. Todo el personal parece estar realmente contento de ayudarte. El hotel también tiene: un elevador, recepción las 24 horas, máquinas expendedoras en el vestíbulo, una cómoda sala de estar con TV, Internet inalámbrica (wi-fi) sin cargo en la cafetería. El hotel ofrece desayuno buffet sin costo adicional</p>
                <img src="<?php echo SERVERURL; ?>vistas/images/junior.webp" alt="customer image">
                <span>Robert Downey Jr</span>
            </div>
            <!-- adios iron-mman -->
            <!-- la sabrosonga -->
            <div class="customer">
                <div class="rating">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                </div>
                <h3>Espectacular diseño </h3>
                <p>Las suites poseen bellísimas terrazas con pisos de madera y muchas de plantas. Sentirás como si estuvieras en tu propio jardín privado. En las suites también recibirás flores y frutas de regalo cuando llegues. Cada habitación cuenta con: baño en suite, aire acondicionado y calefacción central, Internet inalámbrico, TV satelital interactiva, minibar, caja de seguridad y secador de cabello. ¡Los cuartos parecen resplandecer con la luz! Todo está decorado en tonos crema, marfil y beige y está realizado con muy buen gusto. El efecto es celestial.</p>
                <img src="<?php echo SERVERURL; ?>vistas/images/mia.jpg" alt="customer image">
                <span>Mia Khalifa </span>
            </div>
            <!-- esa fue nuestra khalifa -->
        </div>
    </div>
</section>
<!-- fin del cuerpo -->

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