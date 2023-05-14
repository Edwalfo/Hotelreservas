<!--offcanvas-->

<div class="offcanvas offcanvas-start bg-success sidebar-nav"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">



    <div class="offcanvas-body p-2 ">
        <nav class="navbar-dark ">
            <!--lista principal sidebar-->
            <ul class="navbar-nav fs-5 text-light">

                <li>
                    <a href="<?php echo SERVERURL; ?>home/" class="nav-link px-5 active">
                        <span class="me-2"><i class="bi bi-house"></i></span>
                        <span class="text-white fw-bold">Inicio</span>
                    </a>
                </li>

                <li class="my-1">
                    <hr class="dropdown-divider bg-light" />
                </li>
                <li>
                    <div class="fw-bold px-3 mb-3 active">
                        Administración
                    </div>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>reserva/" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-calendar3"></i></span>
                        <span>Reservas</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>recepcion/" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-journal"></i></span>
                        <span>Recepción</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>checkout/" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-coin"></i></span>
                        <span>Check out</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>registrarHuesped/" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-people-fill"></i></span>
                        <span>Huéspedes</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>facturar/" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-receipt-cutoff"></i></span>
                        <span>Facturas</span>
                    </a>
                </li>

               

                <li class="my-1">
                    <hr class="dropdown-divider bg-light" />
                </li>


              
                <?php if( $_SESSION['tipo_SHotel']==1){?>
                <li>
                    <div class="fw-bold px-3 mb-3 active">
                        Configuración
                    </div>
                </li>
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#habitacion">
                        <span class="me-3"><i class="bi bi-gear-fill"></i></span>
                        <span>Habitación</span>
                        <span class="ms-auto">
                            <span class="right-icon">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </span>
                    </a>
                    <div class="collapse fs-6" id="habitacion">
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="<?php echo SERVERURL; ?>tipoHabitacion/" class="nav-link px-3">
                                    <span><i class="bi bi-circle"></i></span>
                                    <span class="fs-6">Crear tipos</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>crearHabitacion/" class="nav-link px-3">
                                    <span><i class="bi bi-circle"></i></span>
                                    <span class="fs-6">Crear Habitaciones</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#otras">
                        <span class="me-3"><i class="bi bi-gear-fill"></i></span>
                        <span>Otras</span>
                        <span class="ms-auto">
                            <span class="right-icon">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </span>
                    </a>
                    <div class="collapse fs-6" id="otras">
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="<?php echo SERVERURL; ?>tipoDocumento/" class="nav-link px-3">
                                    <span><i class="bi bi-circle"></i></span>
                                    <span class="fs-6">Tipos identifacion</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>estadoReserva/" class="nav-link px-3">
                                    <span><i class="bi bi-circle"></i></span>
                                    <span class="fs-6">Estados reservas</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="<?php echo SERVERURL; ?>crearUsuario/" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-gear-fill"></i></span>
                        <span>Usuario</span>
                    </a>
                </li>
             


                <li class="my-1">
                    <hr class="dropdown-divider bg-light" />
                </li>
                <?php }?>
                <li>
                    <div class="fw-bold px-3 mb-3 active">
                        Reportes
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-graph-up"></i></span>
                        <span>Charts</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-3"><i class="bi bi-table"></i></span>
                        <span>Tables</span>
                    </a>
                </li>
            </ul>

        </nav>

    </div>
</div>
<!--offcanvas-->